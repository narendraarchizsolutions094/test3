<br>
<script src="https://cdn.tiny.cloud/1/82ebac134d772tbx3olhim9yme0o5ed3xt3viu42lmgviyu7/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
  mentions_fetch: mentions_fetch,
  mentions_menu_hover: mentions_menu_hover,
  mentions_menu_complete: mentions_menu_complete,
  mentions_select: mentions_select
});


  </script>