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
                                                           <textarea name="content" class="form-control" required><?= $value->content; ?></textarea>

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
    tinymce.init({
      selector: 'textarea',
      plugins: 'quickbars,lists advlist',
      toolbar: 'true',
      toolbar_mode: 'floating',
      });
      
  </script>