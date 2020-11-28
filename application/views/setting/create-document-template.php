<br>
<?php foreach ($docList as $key => $value) { ?>

<div  class="panel panel-default thumbnail">

      <div class="panel-body panel-form">

                          <div class="row ">

                              <div class="col-md-12">  <a class="btn btn-primary" href="<?php echo base_url() ?>setting/document-templates"> <i class="fa fa-list"></i> Template List</a> </div>

                                  <div class="col-md-12 col-sm-12">

                                  <form   action='<?= base_url('setting/Insert_templates') ?>' method="post" enctype="multipart/form-data">
                                   <input value="<?=  $this->uri->segment(3); ?>" name="docId" hidden >
                                      <div class="row"><br>

                                          <div class="col-md-12">

                                             <div class="col-md-12">

                                                      <div class="form-group ">

                                                           <label for="name" class="col-form-label">Title</label>
                                                          <input type="text" class="form-control br_25  m-0 icon_left_input" name="title" required placeholder="title" value="<?= $value->title; ?>" >
                                                      </div>

                                                  </div>

                                                  

                                                  <div class="col-md-12">

                                                      <div class="form-group ">

                                                           <label for="name" class="col-form-label">Content</label>
                                                           <!-- <textarea name="content" class="form-control" required></textarea> -->
                                    <textarea name="content" class="tinymce form-control" placeholder="" id="degree" maxlength="140" rows="7"><?= $value->content; ?></textarea>

                                                           <!-- <textarea name="content" class="form-control" id="summernote" required><?= $value->content; ?></textarea> -->


                                                      </div>

                                                  </div>
                                          </div>
                                                  <div class="col-md-6">
                                                      <button class="btn btn-primary" type="submit" >
                                                          <i class="ti-user"></i>
                                                          <?php echo display("save"); ?>
                                                      </button>
                                                      <button class="btn btn-warning" type="reset" id="clear">
                                                          <i class="ti-reload"></i>
                                                          <?php echo display("reset"); ?>
                                                      </button>
                                                  </div>

                                      </div>

                                  </form>
                                           </div>
                            </div>
              </div>
</div>
<?php } ?>
  <script>
    // tinymce.init({
    //   selector: 'textarea',
    //   plugins: 'quickbars,lists advlist',
    //   toolbar: 'true',
    //   toolbar_mode: 'floating',
    //   });
      
      
var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

tinymce.init({
  selector: 'textarea',
  plugins: 'print preview powerpaste casechange importcss searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable',
  file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    /*
      Note: In modern browsers input[type="file"] is functional without
      even adding it to the DOM, but that might not be the case in some older
      or quirky browsers like IE, so you might want to add it to the DOM
      just in case, and visually hide it. And do not forget do remove it
      once you do not need it anymore.
    */

    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.onload = function () {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };

    input.click();
  },
  mobile: {
    plugins: 'print preview powerpaste casechange importcss searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker textpattern noneditable help formatpainter pageembed charmap mentions quickbars linkchecker emoticons advtable'
  },
  menu: {
    tc: {
      title: 'TinyComments',
      items: 'addcomment showcomments deleteallconversations'
    }
  },
  menubar: 'file edit view insert format tools table tc help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
  autosave_ask_before_unload: true,
  autosave_interval: '30s',
  autosave_prefix: '{path}{query}-{id}-',
  autosave_restore_when_empty: false,
  autosave_retention: '2m',
  image_advtab: true,
  importcss_append: true,
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
  height: 600,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: 'mceNonEditable',
  toolbar_mode: 'sliding',
  spellchecker_whitelist: ['Ephox', 'Moxiecode'],
  tinycomments_mode: 'embedded',
  content_style: '.mymention{ color: gray; }',
  contextmenu: 'link image imagetools table configurepermanentpen',
  a11y_advanced_options: true,
  skin: useDarkMode ? 'oxide-dark' : 'oxide',
  content_css: useDarkMode ? 'dark' : 'default',
  mentions_selector: '.mymention',
  mentions_menu_hover: mentions_menu_hover,
  mentions_menu_complete: mentions_menu_complete,
  mentions_select: mentions_select
});


  </script>