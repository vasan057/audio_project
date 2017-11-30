  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

  <script type="text/javascript" src="{{asset('assets/texteditor/js/froala_editor.min.js')}}" ></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/align.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/char_counter.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/code_beautifier.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/code_view.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/colors.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/draggable.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/emoticons.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/entities.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/file.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/font_size.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/font_family.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/fullscreen.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/image.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/image_manager.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/line_breaker.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/inline_style.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/link.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/lists.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/paragraph_format.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/paragraph_style.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/quick_insert.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/quote.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/table.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/save.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/url.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/texteditor/js/plugins/video.min.js')}}"></script>

  <script>
    $(function(){
      $('#description').froalaEditor({
        // Define new image styles.
        imageStyles: {
          class1: 'Class 1',
          class2: 'Class 2'
        },
		fontFamily: {
			'Chalkduster': 'Chalkduster',
			'Optima': 'Optima',
      'Krungthep': 'Krungthep'
        },
        fontFamilySelection: true
      })
    });
  </script>