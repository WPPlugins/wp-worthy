<?PHP

  /**
   * Copyright (C) 2013 Bernd Holzmueller <bernd@quarxconnect.de>
   *
   * This program is free software: you can redistribute it and/or modify
   * it under the terms of the GNU General Public License as published by
   * the Free Software Foundation, either version 3 of the License, or   
   * (at your option) any later version.
   * 
   * This program is distributed in the hope that it will be useful,
   * but WITHOUT ANY WARRANTY; without even the implied warranty of 
   * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the  
   * GNU General Public License for more details.  
   *  
   * You should have received a copy of the GNU General Public License
   * along with this program.  If not, see <http://www.gnu.org/licenses/>.
   **/
  
  if (!class_exists ('WP_List_Table'))
    require_once (ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
  
  class wp_worthy_table_posts extends WP_List_Table {
    private $Parent;
    
    // {{{ __construct
    /**
     * Setup new address table
     * 
     * @param plugin $Parent
     * 
     * @access friendly
     * @return void
     **/
    function __construct ($Parent) {
      parent::__construct (array (
        'singular' => 'post',
        'plural' => 'posts',
        'ajax' => false,
      ));
      
      if (isset ($_REQUEST ['wp-worthy-filter-length']) && ($_REQUEST ['wp-worthy-filter-length'] == 0) &&
          !isset ($_REQUEST ['orderby'])) {
        $_GET ['orderby'] = $_REQUEST ['orderby'] = 'characters';
        $_GET ['order'] = $_REQUEST ['order'] = 'desc';
      }
      
      $this->Parent = $Parent;
    }
    // }}}
    
    // {{{ setupOptions
    /**
     * Setup screen-options for this table
     * 
     * @access public
     * @return void
     **/
    public static function setupOptions () {
      add_screen_option ('per_page', array (
        'label' => __ ('Posts', 'wp-worthy'),
        'default' => 20,
        'option' => 'wp_worthy_posts_per_page'
      ));
    }
    // }}}
    
    // {{{ setupColumns
    /**
     * Setup columns used in this table
     * 
     * @access public
     * @return array
     **/
    public static function setupColumns () {
      return array (
        'cb' => '<input type="checkbox" />',
        'title' => __ ('Title'),
        'author' => __ ('Author'),
        'categories' => __ (get_taxonomy ('category')->labels->name),
        'post_tag' => __ (get_taxonomy ('post_tag')->labels->name),
        'date' => __ ('Date'),
        'marker' => __ ('Marker', 'wp-worthy'),
        'size' => __ ('Total Size', 'wp-worthy'),
        'characters' => __ ('Relevant Characters', 'wp-worthy'),
        'status' => __ ('Status', 'wp-worthy'),
      );
    }
    // }}}
    
    // {{{ get_columns
    /**
     * Retrive all columns
     * 
     * @access public
     * @return array
     **/
    public function get_columns () {
      return get_column_headers (get_current_screen ());
    }
    // }}}
    
    // {{{ get_sortable_columns
    /**
     * Retrive a list of columns on this table that are sortable
     * 
     * @access public
     * @return array 
     **/
    public function get_sortable_columns () {
      return array (
        'title' => 'post_title',
        'author' => 'author',
        'date' => 'post_date',
        'marker' => 'private',
        'size' => 'size',
        'characters' => 'characters',
      );
    }
    // }}}
    
    // {{{ column_default
    /**
     * Retrive default data for any column
     * 
     * @param object $item
     * @param string $column_name
     * 
     * @access public
     * @return string
     **/
    public function column_default ($item, $column_name) {
      return $item->$column_name;
    }
    // }}}
    
    // {{{ column_cb
    /**
     * Retrive marker for bulk-actions
     * 
     * @param object $item
     * 
     * @access public
     * @return string
     **/
    public function column_cb ($item) {
      if (is_object ($item) && isset ($item->Public) && (strlen ($item->Public) > 0))
        return '&nbsp;';
      
      return '<input id="cb-select-' . $item->ID . '" type="checkbox" name="post[]" value="' . $item->ID . '" />';
    }
    // }}}
    
    // {{{ column_title
    /**
     * Retrive content for the title-column
     * 
     * @param object $item
     * 
     * @access public
     * @return string
     **/
    public function column_title ($item) {
      if (!is_object ($item) || (isset ($item->Public) && (strlen ($item->Public) > 0)) || ($this->Parent->getPostLength ($item) < wp_worthy::MIN_LENGTH))
        return $this->Parent->wpLinkPost ($item);
      
      return '<strong>' . $this->Parent->wpLinkPost ($item) . '</strong>';
    }
    // }}}
    
    // {{{ column_author
    /**
     * Retrive contents of author-column
     * 
     * @param object $item
     * 
     * @access public
     * @return string
     **/
    public function column_author ($item) {
      return
        $item->author . '<br />' .
        ($item->userid && (strlen ($vgWortUser = get_user_meta ($item->userid, 'worthy_premium_username', true)) > 0) ? '<nobr><strong>VG-Wort:</strong> ' . $vgWortUser . '</nobr>' : '');
    }
    // }}}
    
    // {{{ column_categories
    /**
     * Retrive all categories for a given post
     * 
     * @param object $item
     * 
     * @access public
     * @return string
     **/
    public function column_categories ($item) {
      global $wpdb;
      
      $items = $wpdb->get_results ($wpdb->prepare ('SELECT t.name FROM `' . $this->Parent->getTablename ('terms') . '` t, `' . $this->Parent->getTablename ('term_taxonomy') . '` tt, `' . $this->Parent->getTablename ('term_relationships') . '` tr WHERE t.term_id=tt.term_id AND tt.term_taxonomy_id=tr.term_taxonomy_id AND tr.object_id=%d AND tt.taxonomy="category"', $item->ID));
      
      if (count ($items) == 0)
        return '&#8212;';
      
      foreach ($items as $k=>$item)
        $items [$k] = $item->name;
      
      return implode (__ (', '), $items);
    }
    // }}}
    
    // {{{ column_post_tag
    /**
     * Retrive all tags for a given post
     * 
     * @param object $item
     * 
     * @access public
     * @return string
     **/
    public function column_post_tag ($item) {
      global $wpdb;
      
      $items = $wpdb->get_results ($wpdb->prepare ('SELECT t.name FROM `' . $this->Parent->getTablename ('terms') . '` t, `' . $this->Parent->getTablename ('term_taxonomy') . '` tt, `' . $this->Parent->getTablename ('term_relationships') . '` tr WHERE t.term_id=tt.term_id AND tt.term_taxonomy_id=tr.term_taxonomy_id AND tr.object_id=%d AND tt.taxonomy="post_tag"', $item->ID));
      
      if (count ($items) == 0)
        return '&#8212;';
     
      foreach ($items as $k=>$item)
        $items [$k] = $item->name;
      
      return implode (__ (', '), $items);
    }
    // }}}
    
    // {{{ column_date
    /**
     * Retrive the date of a post
     * 
     * @param object $item
     * 
     * @access public
     * @return string
     **/
    public function column_date ($item) {
      if ($item->post_date == '0000-00-00 00:00:00')
        return __ ('Unpublished');
      
      $t_time = get_the_time (__ ('Y/m/d g:i:s A'));
      $m_time = $item->post_date;
      $time = get_post_time ('G', true, $item);
      $time_diff = time () - $time;
      
      if (($time_diff > 0) && ($time_diff < DAY_IN_SECONDS))
        $h_time = sprintf (__ ('%s ago'), human_time_diff ($time));
      else
        $h_time = mysql2date (__ ('Y/m/d'), $m_time);
      
      return '<abbr title="' . $t_time . '">' . apply_filters ('post_date_column_time', $h_time, $item, 'date', 'list') . '</abbr>';
    }
    // }}}
    
    // {{{ column_marker
    /**
     * Generate marker-column
     * 
     * @param object $item
     * 
     * @access public
     * @return string
     **/
    public function column_marker ($item) {
      if (!$item->public)
        return;
      
      if (isset ($_REQUEST ['wp-worthy-demo'])) {
        if ($item->private)
          $item->private = substr ($item->private, 0, -6) . 'xxxxxx';
        
        if ($item->public)
          $item->public = substr ($item->public, 0, -6) . 'xxxxxx';
      }
      
      return
        '<abbr title="' . __ ('Private Marker', 'wp-worthy') . '">' . __ ('Priv', 'wp-worthy') . '</abbr>: ' . $item->private . '<br />' .
        '<abbr title="' . __ ('Public Marker', 'wp-worthy') . '">' . __ ('Publ', 'wp-worthy') . '</abbr>: ' . $item->public . '<br />' . 
        '<abbr title="' . __ ('Server', 'wp-worthy') . '">' . __ ('Serv', 'wp-worthy') . '</abbr>: ' . $item->server;
    }
    // }}}
    
    // {{{ column_size
    /**
     * Retrive the total size of a post
     * 
     * @access public
     * @return string
     **/
    public function column_size ($item) {
      return  sprintf (__ ('%d chars', 'wp-worthy'), strlen ($item->post_content));
    }
    // }}}
    
    // {{{ column_characters
    /**
     * Retrive the number of characters for a post
     * 
     * @param object $item
     * 
     * @access public
     * @return string
     **/
    public function column_characters ($item) {
      // Retrive the relevant length for the given post
      $length = $this->Parent->getPostLength ($item);
      
      if (($p = $this->Parent) && ($length < $p::MIN_LENGTH) && (!isset ($item->is_lyric) || ($item->is_lyric != '1')))
        return sprintf (__ ('%d chars', 'wp-worthy'), $length) . '<br />' .
               '<small>(' . sprintf (__ ('%d chars missing', 'wp-worthy'), $p::MIN_LENGTH - $length) . ')</small>';
      
      return sprintf (__ ('%d chars', 'wp-worthy'), $length);
    }
    // }}}
    
    // {{{ column_status
    /**
     * Retrive the worthy-status of a post
     * 
     * @param object $item
     * 
     * @access public
     * @return string
     **/
    public function column_status ($item) {
      if (isset ($_REQUEST ['displayPostsForMigration'])) {
        static $inlineIDs = null;
        static $vgwIDs = null;
        static $wpvgIDs = null;
        static $wppvgwIDs = null;
        
        // Check if we already collected IDs
        if ($inlineIDs === null) {
          $inlineIDs = $this->Parent->migrateInline (false, true);
          $vgwIDs = $this->Parent->migrateByMeta (array ('vgwpixel'), false, true);
          $wpvgIDs = $this->Parent->migrateByMeta (array (get_option ('wp_vgwortmetaname', 'wp_vgwortmarke')), false, true);
          $wppvgwIDs = $this->Parent->migrateProsodia (false, true);
        }
        
        return
          '<ul>'.
            (in_array ($item->ID, $inlineIDs) ? '<li>' . __ ('Contains an inlined marker', 'wp-worthy') . '</li>' : '') .
            (in_array ($item->ID, $vgwIDs) ? '<li>' . __ ('Is managed by VGW', 'wp-worthy') . '</li>' : '') .
            (in_array ($item->ID, $wpvgIDs) ? '<li>' . __ ('Is managed by WP VG-Wort', 'wp-worthy') . '</li>' : '') .
            (in_array ($item->ID, $wppvgwIDs) ? '<li>' . __ ('Is managed by Prosodia VGW', 'wp-worthy') . '</li>' : '') .
            (strlen ($item->public) > 0 ? '<li><strong>' . __ ('Already managed by Worthy', 'wp-worthy') . '</strong></li>' : '') .
            '<li><a href="#" onclick="worthy_bulk_single(\'wp-worthy-bulk-migrate\', \'' . $item->ID . '\');">' . __ ('Migrate post', 'wp-worthy') . '</a></li>' .
          '</ul>';
      }
      
      $P = $this->Parent;
      $isRelevant = (($Length = $P->getPostLength ($item)) >= $P::MIN_LENGTH) || (isset ($item->is_lyric) && ($item->is_lyric == '1'));
      $hasMarker = (strlen ($item->public) > 0);
      $Links = '';
      
      if ($isRelevant == $hasMarker) {
        $Status = '<span class="' . ($isRelevant ? 'wp-worthy-relevant wp-worthy-marker' : 'wp-worthy-neutral') . '">OK</span>';
        
        if (defined ('WORTHY_PREMIUM') && WORTHY_PREMIUM && $isRelevant) {
          static $Map = array (
            0 => '', 
            1 => 'not qualified',
            2 => 'partial qualified',
            3 => 'qualified',
            4 => 'reported',
          );
          
          $Status .=
            '<span class="wp-worthy-status-' . intval ($item->status) . '">' . __ ($Map [intval ($item->status)], 'wp-worthy') . '</span>';
          
          if ($item->private && ($item->status < 4))
            $Links =
              '<li><a href="#" onclick="worthy_bulk_single(\'wp-worthy-premium-create-webareas\', \'' . $item->ID . '\');">' . __ ('Create webarea', 'wp-worthy') . '</a></li>' .
              ((($item->status == 3) && ($Length >= wp_worthy::MIN_LENGTH)) || (($item->status == 2) && ($Length >= wp_worthy::EXTRA_LENGTH)) ?
                '<li><a href="#" onclick="worthy_bulk_single(\'wp-worthy-premium-report-posts-preview\', \'' . $item->ID . '\');">' . __ ('Preview report for VG-Wort', 'wp-worthy') . '</a></li>' . 
                (strlen ($item->post_title) > 100 ? '' :
                '<li><a href="#" onclick="worthy_bulk_single(\'wp-worthy-premium-report-posts\', \'' . $item->ID . '\');">' . __ ('Report directly to VG-Wort', 'wp-worthy') . '</a></li>') : ''
              );
          else
            $Links = '';
        }
      } elseif ($isRelevant) {
        $Status = '<span class="wp-worthy-relevant worthy-nomarker wp-worthy-warning">' . __ ('Needs marker', 'wp-worthy') . '</span>';
        $Links = '<li><a href="#" onclick="worthy_bulk_single(\'wp-worthy-bulk-assign\', \'' . $item->ID . '\');">' . __ ('Assign marker', 'wp-worthy') . '</a></li>';
      } else
        $Status =
          '<span class="wp-worthy-neutral wp-worthy-marker">OK</span>' .
          '<span class="wp-worthy-notice">' . __ ('Marker assigned without need', 'wp-worthy') . '</span>';
      
      $Links .= '<li><a href="#" class="wp-worthy-danger" onclick="worthy_bulk_single(\'wp-worthy-bulk-ignore\', \'' . $item->ID . '\');">' . __ ('Ignore this post', 'wp-worthy') . '</a></li>';
      
      // Sanity-check length of title
      if ($isRelevant && (strlen ($item->post_title) > 100))
        $Status .= '<span class="wp-worthy-warning">' . __ ('Title is too long', 'wp-worthy') . '</span>';
      
      // Sanity-check user-ids
      $postUserIDs = $this->Parent->getUserIDs ($item->post_author);
      
      if ($hasMarker && $item->userid && !in_array ($item->userid, $postUserIDs))
        $Status .= '<span class="wp-worthy-warning" title="' . __ ('The author of the post does not match the owner of the marker', 'wp-worthy') . '">' . __ ('User-ID conflict', 'wp-worthy') . '</span>';
      elseif ($isRelevant && !in_array ($this->Parent->getUserID (), $postUserIDs)) {
        $Status .= '<span class="wp-worthy-notice" title="' . __ ('You are not the author of this post or assigned to him/her, you cannot assign a marker to this post', 'wp-worthy') . '">' . __ ('Foreign User-ID', 'wp-worthy') . '</span>';
        $Links = '';
      }
      
      if (defined ('WP_DEBUG') && WP_DEBUG)
        $Links .= '<li><a href="#" class="wp-worthy-danger" onclick="worthy_bulk_single(\'wp-worthy-reindex\', \'' . $item->ID . '\');">' . __ ('Reindex this post', 'wp-worthy') . '</a></li>';
      
      return
        $Status .
        (strlen ($Links) > 0 ? '<ul>' . $Links . '</ul>' : '');
    }
    // }}}
    
    // {{{ get_bulk_actions
    /**
     * Retrive a list of all bulk-actions
     *    
     * @access public
     * @return array
     **/
    public function get_bulk_actions () {
      $Actions = array ();
      
      if (isset ($_REQUEST ['displayPostsForMigration']))
        $Actions ['wp-worthy-bulk-migrate'] = __ ('Migrate posts', 'wp-worthy');
      
      $Actions ['wp-worthy-bulk-assign'] = __ ('Assign markers', 'wp-worthy');
      $Actions ['wp-worthy-bulk-ignore'] = __ ('Ignore posts', 'wp-worthy');
      
      if (defined ('WORTHY_PREMIUM') && WORTHY_PREMIUM) {
        $Actions ['wp-worthy-premium-report-posts-preview'] = __ ('Report with preview', 'wp-worthy');
        $Actions ['wp-worthy-premium-report-posts'] = __ ('Report without preview', 'wp-worthy');
        $Actions ['wp-worthy-premium-create-webareas'] = __ ('Create webareas', 'wp-worthy');
      }
      
      if (defined ('WP_DEBUG') && WP_DEBUG)
        $Actions ['wp-worthy-reindex'] = __ ('Reindex posts', 'wp-worthy');
      
      return $Actions;
    }   
    // }}}
    
    // {{{ prepare_items
    /**
     * Preload all items displayed on this table
     * 
     * @access public
     * @return void
     **/
    public function prepare_items () {
      global $wpdb;
      
      $per_page = $this->get_items_per_page ('wp_worthy_posts_per_page');
      $page = $this->get_pagenum ();
      
      // Handle sorting of items
      $haveCounter = false;
      $From = '';
      
      $sort_field = 'ID';
      $sort_order = 'DESC';
      
      if (isset ($_REQUEST ['orderby']) && in_array ($_REQUEST ['orderby'], $this->get_sortable_columns ()))
        $sort_field = $_REQUEST ['orderby'];
      
      if ($sort_field == 'size')
        $sort_field = 'LENGTH(post_content)';
      elseif ($sort_field == 'characters') {
        $From .= 'LEFT JOIN `' . $this->Parent->getTablename ('postmeta') . '` pm ON (p.ID=pm.post_id AND pm.meta_key="' . wp_worthy::META_LENGTH . '") ';
        $haveCounter = true;
        $sort_field = 'CONVERT(pm.meta_value, UNSIGNED INTEGER)';
      }
      
      
      if (isset ($_REQUEST ['order']) && in_array ($_REQUEST ['order'], array ('asc', 'desc')))
        $sort_order = $_REQUEST ['order'];
      
      // Handle filters
      $Where = '';
      
      if (isset ($_REQUEST ['worthy-filter-author']) && ($_REQUEST ['worthy-filter-author'] >= 0))
        $Where .= ' AND post_author="' . intval ($_REQUEST ['worthy-filter-author']) . '"';
      
      if (isset ($_REQUEST ['m']) && ($_REQUEST ['m'] != 0)) {
        $Year = intval (substr ($_REQUEST ['m'], 0, 4));
        $Month = intval (substr ($_REQUEST ['m'], 4, 2));
        
        $Where .= $wpdb->prepare (' AND (YEAR(post_date)=%d AND MONTH(post_date)=%d)', $Year, $Month);
      }
      
      if (isset ($_REQUEST ['cat']) && ($_REQUEST ['cat'] != 0)) {
        $From .=
          'LEFT JOIN `' . $this->Parent->getTablename ('term_relationships') . '` tr ON (tr.object_id=p.ID) ' .
          'LEFT JOIN `' . $this->Parent->getTablename ('term_taxonomy') . '` tt ON (tr.term_taxonomy_id=tt.term_taxonomy_id AND tt.taxonomy="category") ' .
        
        $Where .= $wpdb->prepare (' AND tt.term_id=%d', $_REQUEST ['cat']);
      }
      
      if (isset ($_REQUEST ['wp-worthy-filter-length']) && ($_REQUEST ['wp-worthy-filter-length'] >= 0)) {
        if (!$haveCounter)
          $From .= 'LEFT JOIN `' . $this->Parent->getTablename ('postmeta') . '` pm ON (p.ID=pm.post_id AND pm.meta_key="' . wp_worthy::META_LENGTH . '") ';
        
        $Where .= ' AND (pm.meta_value' . ($_REQUEST ['wp-worthy-filter-length'] == 0 ? '<' : '>=') . ($_REQUEST ['wp-worthy-filter-length'] == 2 ? strval (wp_worthy::EXTRA_LENGTH) : strval (wp_worthy::MIN_LENGTH)) . ')';
      }
      
      if (isset ($_REQUEST ['wp-worthy-filter-marker']))
        switch ($_REQUEST ['wp-worthy-filter-marker']) {
          case '0':
          case '1':
            $Where .= ' AND ' . ($_REQUEST ['wp-worthy-filter-marker'] % 2 == 1 ? 'NOT ' : '') . '(public IS NULL)';
            
            break;
          case 's0':
          case 's1':
          case 's2':
          case 's3':
          case 's4':
            $Where .= ' AND (status="' . intval ($_REQUEST ['wp-worthy-filter-marker'][1]) . '")'; 
            
            break;
          case 'sr':
            if (!$haveCounter)
              $From .= 'LEFT JOIN `' . $this->Parent->getTablename ('postmeta') . '` pm ON (p.ID=pm.post_id AND pm.meta_key="' . wp_worthy::META_LENGTH . '") ';
            
            $Where .= ' AND ((status=3) OR (status=2 AND pm.meta_value>=' . wp_worthy::EXTRA_LENGTH . '))';
            
            break;
        }
      
      if (isset ($_REQUEST ['displayPostsForMigration'])) {
        $IDs = explode (',', $_REQUEST ['displayPostsForMigration']);
        
        foreach ($IDs as $i=>$ID)
          $IDs [$i] = intval ($ID);
        
        $Where .= ' AND p.ID IN (' . implode (',', $IDs) . ')';
      }
      
      if (isset ($_REQUEST ['s']) && (strlen (trim ($_REQUEST ['s'])) > 0))
        $Where .= $wpdb->prepare (' AND (private LIKE "%%%%%s%%%%" OR public LIKE "%%%%%s%%%%")', trim ($_REQUEST ['s']), trim ($_REQUEST ['s']));
      
      // Do the query
      $this->items = $wpdb->get_results (sprintf (
        'SELECT SQL_CALC_FOUND_ROWS p.*, c.public, c.private, c.status, c.server, c.userid, u.display_name AS author, l.meta_value AS is_lyric ' .
        'FROM `' . $this->Parent->getTablename ('posts')  . '` p ' .
          'LEFT JOIN `' . $this->Parent->getTablename ('worthy_markers', true) . '` c ON (p.ID = c.postid) ' .
          'LEFT JOIN `' . $this->Parent->getTablename ('users') . '` u ON (p.post_author=u.ID)' .
          'LEFT JOIN `' . $this->Parent->getTablename ('postmeta') . '` i ON (p.ID=i.post_id AND i.meta_key="worthy_ignore") ' . 
          'LEFT JOIN `' . $this->Parent->getTablename ('postmeta') . '` l ON (p.ID=l.post_id AND l.meta_key="worthy_lyric") ' . $From . ' ' .
        'WHERE ' .
          'post_type IN (' . (isset ($_REQUEST ['wp-worthy-filter-post-type']) && $_REQUEST ['wp-worthy-filter-post-type'] ? $wpdb->prepare ('%s', $_REQUEST ['wp-worthy-filter-post-type']) : '"' . implode ('","', $this->Parent->getUserPostTypes ()) . '"') . ') AND ' .
          'post_status="publish"' . $Where . ' AND ' .
          '((i.meta_value IS NULL) OR NOT (i.meta_value="1")) ' .
        'ORDER BY %s %s LIMIT %d,%d', $sort_field, $sort_order, ($page - 1) * $per_page, $per_page
      ));
      
      // Setup this table
      $total = $wpdb->get_var ('SELECT FOUND_ROWS()');
      
      $this->set_pagination_args (array (
        'total_items' => $total,
        'per_page' => $per_page,
        'total_pages' => ceil ($total / $per_page),
      ));
    }
    // }}}
    
    // {{{ extra_tablenav
    /**
     * Output additional filters for navigation
     * 
     * @access public
     * @return void
     **/
    public function extra_tablenav ($which) {
      if ($which != 'top')
        return;
      
      echo '<div class="alignleft actions">';
      
      if (count ($Users = $GLOBALS ['wpdb']->get_results ('SELECT m.userid, u.display_name FROM `' . $this->Parent->getTablename ('worthy_markers', true)  . '` m, `' . $this->Parent->getTablename ('users')  . '` u WHERE m.userid=u.ID GROUP BY userid')) > 1) {
        $uid = (isset ($_REQUEST ['worthy-filter-author']) ? intval ($_REQUEST ['worthy-filter-author']) : -1);
        
        echo
          '<select name="worthy-filter-author">', 
            '<option value="-1">', __ ('Display all authors', 'wp-worthy'), '</option>';
        
        foreach ($Users as $User)
          echo '<option value="', $User->userid, '"', ($uid == $User->userid ? ' selected="1"' : ''), '>', $User->display_name, '</option>';
        
        echo '</select>';
      }
      
      // Display post-type-filter
      echo
        '<select name="wp-worthy-filter-post-type">',
          '<option value="">', __ ('Display all post-types', 'wp-worthy'), '</option>';
      
      foreach ($this->Parent->getUserPostTypes () as $postType)
        if (is_object ($postType = get_post_type_object ($postType)))
          echo '<option value="', esc_html ($postType->name), '"', (isset ($_REQUEST ['wp-worthy-filter-post-type']) && ($_REQUEST ['wp-worthy-filter-post-type'] == $postType->name) ? ' selected="1"' : ''), '>', esc_html ($postType->labels->name), '</option>';
      
      echo
        '</select>';
      
      // Display month-filter
      $this->months_dropdown ('post');
      
      // Display category-filter
      $dropdown_options = array (
        'show_option_all' => __ ('View all categories'),
        'hide_empty' => 0,
        'hierarchical' => 1,
        'show_count' => 0,  
        'orderby' => 'name',
        'selected' => (isset ($_REQUEST ['cat']) ? intval ($_REQUEST ['cat']) : null),
      );
      wp_dropdown_categories ($dropdown_options);
      
      // Display worthy-filter
      if (isset ($_REQUEST ['wp-worthy-filter-length']) && ($_REQUEST ['wp-worthy-filter-length'] < 0))
        unset ($_REQUEST ['wp-worthy-filter-length']);
      
      if (isset ($_REQUEST ['wp-worthy-filter-marker']) && ($_REQUEST ['wp-worthy-filter-marker'] < 0))
        unset ($_REQUEST ['wp-worthy-filter-marker']);
      
      echo
        '<select name="wp-worthy-filter-length">',
          '<option value="-1">', __ ('Display all posts', 'wp-worthy'), '</option>',
          '<option value="0"', (isset ($_REQUEST ['wp-worthy-filter-length']) && ($_REQUEST ['wp-worthy-filter-length'] == '0') ? ' selected="1"' : ''), '>', __ ('Posts that are not long enough', 'wp-worthy'), '</option>',
          '<option value="1"', (isset ($_REQUEST ['wp-worthy-filter-length']) && ($_REQUEST ['wp-worthy-filter-length'] == '1') ? ' selected="1"' : ''), '>', __ ('Posts that are suited for VG-Wort', 'wp-worthy'), '</option>',
          '<option value="2"', (isset ($_REQUEST ['wp-worthy-filter-length']) && ($_REQUEST ['wp-worthy-filter-length'] == '2') ? ' selected="1"' : ''), '>', __ ('Posts that are extra long', 'wp-worthy'), '</option>',
        '</select>',
        '<select name="wp-worthy-filter-marker">',
          '<option value="-1">', __ ('Display all posts', 'wp-worthy'), '</option>',
          '<option value="0"', (isset ($_REQUEST ['wp-worthy-filter-marker']) && ($_REQUEST ['wp-worthy-filter-marker'] == '0') ? ' selected="1"' : ''), '>', __ ('Posts without marker assigned', 'wp-worthy'), '</option>',
          '<option value="1"', (isset ($_REQUEST ['wp-worthy-filter-marker']) && ($_REQUEST ['wp-worthy-filter-marker'] == '1') ? ' selected="1"' : ''), '>', __ ('Posts with marker assigned', 'wp-worthy'), '</option>';
      
      if (defined ('WORTHY_PREMIUM') && WORTHY_PREMIUM)
        echo
          '<option value="s0"', (isset ($_REQUEST ['wp-worthy-filter-marker']) && ($_REQUEST ['wp-worthy-filter-marker'] == 's0') ? ' selected="1"' : ''), '>', __ ('Markers that have not been counted', 'wp-worthy'), '</option>',
          '<option value="s1"', (isset ($_REQUEST ['wp-worthy-filter-marker']) && ($_REQUEST ['wp-worthy-filter-marker'] == 's1') ? ' selected="1"' : ''), '>', __ ('Markers that have not qualified yet', 'wp-worthy'), '</option>',
          '<option value="s2"', (isset ($_REQUEST ['wp-worthy-filter-marker']) && ($_REQUEST ['wp-worthy-filter-marker'] == 's2') ? ' selected="1"' : ''), '>', __ ('Markers that are partial qualified', 'wp-worthy'), '</option>',
          '<option value="s3"', (isset ($_REQUEST ['wp-worthy-filter-marker']) && ($_REQUEST ['wp-worthy-filter-marker'] == 's3') ? ' selected="1"' : ''), '>', __ ('Markers that are qualified', 'wp-worthy'), '</option>',
          '<option value="s4"', (isset ($_REQUEST ['wp-worthy-filter-marker']) && ($_REQUEST ['wp-worthy-filter-marker'] == 's4') ? ' selected="1"' : ''), '>', __ ('Markers that were reported', 'wp-worthy'), '</option>',
          '<option value="sr"', (isset ($_REQUEST ['wp-worthy-filter-marker']) && ($_REQUEST ['wp-worthy-filter-marker'] == 'sr') ? ' selected="1"' : ''), '>', __ ('Markers that may be reported', 'wp-worthy'), '</option>';
      
      echo
        '</select>',
        '<button type="submit" class="button action" name="filter_action" value="1">', __ ('Filter'), '</button>';
      
      echo '</div>';
    }
    // }}}
  }
  
  add_filter ('set-screen-option', function ($status, $option, $value) {
    if ($option == 'wp_worthy_posts_per_page')
      return $value;
    
    return $status;
  }, 10, 3);
  
  add_filter ('default_hidden_columns', function ($hidden, $screen) {
    if ($screen != 'worthy_page_wp_worthy-posts')
      return $hidden;
    
    $hidden [] = 'categories';
    $hidden [] = 'post_tag';
    $hidden [] = 'size';
    
    return $hidden;
  }, 10, 2);

?>