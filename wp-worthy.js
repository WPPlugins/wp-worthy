(function($,undefined) {
  worthy = {
    setup : false,
    elem : false,
    pelem : false,
    qualified : false,
    qualified_length : 1800,
    qualified_warn : 1600,
    auto_assign : false,
    contentEditor : null,
    
    counter : function () {
      if (!this.setup) {
        if (!(e = document.getElementById ('wp-word-count')))
          return;
        
        e.appendChild (document.createElement ('br'));
        e.appendChild (document.createTextNode (wpWorthyLang.counter + ': '));
        this.elem = document.createElement ('spam');
        this.elem.setAttribute ('class', 'character-count wp-worthy-counter');
        this.elem.innerHTML = '0';
        this.pelem = document.createElement ('div');
        e.appendChild (this.elem);
        
        this.setup = true;
      }
      
      if (!this.contentEditor || this.contentEditor.isHidden ())
        text = $('#content').val ();
      else
        text = this.contentEditor.getContent ({ format: 'raw' });
      
      
      if (text != false) {
        var p = 0, e = 0, l = 0, s = 0;
        var t = '', n = '';
        
        while ((p = text.indexOf ('[', p)) >= 0) {
          if ((e = text.indexOf (']', p)) < p)
            break;
          
          var ex = '';
          
          t = text.substr (p + 1, e - p - 1);
          
          if (t.charAt (0) != '/') {
            var o = { name : null, attr : { } };
            
            for (s = 0; s < t.length; s++) {
              var c = t.charAt (s);
              
              if (c == ' ') {
                if (o.name == null) {
                  o.name = t.substr (0, s);
                } else {
                  o.attr [t.substr (l, s - l)] = true;
                }
                
                l = s + 1;
              } else if (c == '=') {
                var k = t.substr (l, s - l);
                
                l = ++s;
                c = t.charAt (l);
                
                if ((c == '"') || (c == "'")) {
                  if ((s = t.indexOf (c, l + 1)) >= l + 1)
                    o.attr [k] = t.substr (l + 1, s - l - 1);
                  else
                    break;
                  
                  l = ++s + 1;
                } else if ((s = t.indexOf (' ', l)) >= l) {
                  o.attr [k] = t.substr (l, s - l);
                  l = s;
                } else {
                  o.attr [k] = t.substr (l);
                  s = t.length;
                }
              }
            }
            
            if (o.name == null)
              o.name = t;
            
            if (typeof o.attr.caption != 'undefined')
              ex += o.attr.caption;
            
            if (typeof o.attr.title != 'undefined')
              ex += o.attr.title;
          }
          
          text = text.substr (0, p) + ex + text.substr (e + 1);
          p += ex.length;
        }
        
        this.pelem.innerHTML = text.replace(/(<([^>]+)>)/ig, '').replace ("\r\n", '');
      }
      
      if (this.pelem.childNodes.length == 0)
        len = 0;
      else
        len = (this.pelem.textContent || this.pelem.innerText).length;
      
      this.qualified = (((len >= this.qualified_length) || $('#worthy_lyric').prop ('checked')) && !$('#worthy_ignore').prop ('checked'));
      
      this.elem.innerHTML = len;
      
      if (this.qualified)
        this.elem.setAttribute ('class', 'character-count wp-worthy-counter wp-worthy-length-qualified');
      else if ((len > this.qualified_warn) && (len < this.qualified_length))
        this.elem.setAttribute ('class', 'character-count wp-worthy-counter wp-worthy-length-partial');
      else
        this.elem.setAttribute ('class', 'character-count wp-worthy-counter wp-worthy-length-short');
      
      if ($('#wp-worthy-embed').prop ('disabled') == this.qualified) {
        if (!this.qualified) {
          $('#wp-worthy-embed').prop ('ochecked', $('#wp-worthy-embed').prop ('checked'));
          $('#wp-worthy-embed').prop ('checked', false);
        } else
          $('#wp-worthy-embed').prop ('checked', $('#wp-worthy-embed').prop ('ochecked'));
          
        $('#wp-worthy-embed').prop ('disabled', !this.qualified);
      }
      
      if (this.qualified && this.auto_assign) {
        $('#wp-worthy-embed').prop ('checked', true);
        this.auto_assign = false;
      }
      
      $('#wp-worthy-embed-label').css ('font-weight', this.qualified && !$('#wp-worthy-embed').prop ('checked') ? 'bold' : 'normal');
    },
    
    postNotice : function (message, classes) {
      if (!(p = document.getElementById ('worthy-notices')))
        return;
      
      if (message.indexOf ('<p>') < 0)
        message = '<p><strong>Worthy:</strong> ' + message + '</p>';
      
      c = document.createElement ('div');
      c.className = 'notice fade ' + classes;
      c.innerHTML = message;
      
      p.appendChild (c);
    }
  }
  
  $(document).ready (function () {
    worthy.auto_assign = ($('#wp-worthy-embed').attr ('data-wp-worthy-auto') == 1);
    
    $('#wp-worthy-shop-goods input[type=radio]').change (function () {
      var total = 0;
      var total_tax = 0;
      
      $('#wp-worthy-shop-goods input[type=radio]').each (function () {
        if (!this.checked || (this.value == 'none'))
          return;
        
        total += parseFloat ($(this).attr ('data-value'));
        total_tax += parseFloat ($(this).attr ('data-tax'));
      });
      $('#wp-worthy-shop-price').html (total.toFixed (2).replace ('.', ','));
      $('#wp-worthy-shop-tax').html (total_tax.toFixed (2).replace ('.', ','));
    });
    
    $('#wp-worthy-shop-goods input[type=radio][checked]').change ();
    
    if ($('#wp-worthy-payment-giropay-bic').length > 0)
      $('#wp-worthy-payment-giropay-bic').giropay_widget({'return':'bic','kind':1});
    
    $('div.worthy-signup form').submit (function () {
      if (!$(this).find ('input#wp-worthy-accept-tac').prop ('checked')) {
        alert (wpWorthyLang.accept_tac);
        
        return false;
      }
    });
    
    $('#wp-worthy-shop').submit (function () {
      var have_good = false;
      
      $('#wp-worthy-shop-goods input[type=radio]').each (function () {
        if (this.checked && (this.value != 'none'))
          have_good = true;
      });
      
      if (!have_good) {
        alert (wpWorthyLang.no_goods);
        
        return false;
      }
      
      if (!$(this).find ('input#wp-worthy-accept-tac').prop ('checked')) {
        alert (wpWorthyLang.accept_tac);

        return false;
      }
      
      if ($(this).find ('input#wp-worthy-payment-giropay').prop ('checked') && !$(this).find ('input#wp-worthy-payment-giropay-bic').prop ('value').length) {
        alert (wpWorthyLang.empty_giropay_bic);
        
        return false;
      }
    });
    
    $('span.wp-worthy-inline-title').click (function () {
      var box = document.createElement ('div');
      box.setAttribute ('class', 'wp-worthy-inline-title');
      
      var textbox = document.createElement ('input');
      textbox.setAttribute ('type', 'text');
      textbox.setAttribute ('name', this.getAttribute ('id'));
      textbox.setAttribute ('class', 'wp-worthy-inline-title');
      textbox.value = this.textContent.substr (0, this.textContent.lastIndexOf ("\n"));
      box.appendChild (textbox);
      
      var label = document.createElement ('span');
      label.setAttribute ('class', 'wp-worthy-inline-counter');
      box.appendChild (label);
      
      textbox.onchange = function () {
        label.textContent = '(' + this.value.length + ' ' + wpWorthyLang.characters + ')';
      };
      textbox.oninput = textbox.onchange;
      
      this.parentNode.replaceChild (box, this);
      textbox.onchange ();
    });
    
    $('span.wp-worthy-inline-content').click (function () {
      var textbox = document.createElement ('textarea');
      textbox.setAttribute ('name', this.getAttribute ('id'));
      textbox.setAttribute ('class', 'wp-worthy-inline-content');
      textbox.value = this.textContent;
      textbox.style.height = this.clientHeight + 'px';
      this.parentNode.replaceChild (textbox, this);
    });
    
    $('select#wp-worthy-account-sharing').change (function () {
      $('form.worthy-form .wp-worthy-no-sharing').css ('display', (this.options [this.selectedIndex].value == 0 ? 'block' : 'none'));
    }).change ();
    
    var wpw_subnav = $('<div />').addClass ('subnav');
    
    $('#wp-worthy .stuffbox h2[id]').each (function () {
      wpw_subnav.append ($('<a />').attr ('href', '#' + $(this).attr ('id')).text ($(this).text ()));
    });
    
    if (wpw_subnav.children ().length > 1)
      $('#wp-worthy .nav-tab-wrapper').after (wpw_subnav)
    
    if ($('th#cb input[type=checkbox]').prop ('checked'))
      $('th.check-column input[type=checkbox]').prop ('checked', true);
    
    $('#content').on ('input keyup', function () { worthy.counter (); });
    $(document).on ('tinymce-editor-init', function (ev, ed) {
      if (ed.id != 'content')
        return;
      
      worthy.contentEditor = ed;
      
      ed.on ('nodechange keyup', function () {
        tinyMCE.triggerSave ();
        worthy.counter ();
      });
    });
    
    worthy.counter ();
  });
}(jQuery));
