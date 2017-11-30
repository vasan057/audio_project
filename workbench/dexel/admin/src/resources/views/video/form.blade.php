<div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="background:rgba(255, 255, 255, 0.2);border:1px solid rgba(255, 255, 255, 0.4);border-radius:8px;margin:6% 0;">
              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">x</button>

                <h4 class="modal-title" style="color:#ffffff">Video Information</h4>

              </div>

              <div class="modal-body">

               <form id="form-ui" enctype="multipart/form-data" id="createVideoForm" method="POST">

             <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group" >

            <label for="email" style="color:#ffffff;">Title: <b style="color:red">*</b></label>

            <input type="text" class="form-control" id="title" name="title" required value="{{old('title')}}">
            <span id="title_err" class="form-error"></span>
            <span id="slug_err" class="form-error"></span>
          </div>

          <div class="form-group">

            <label for="" style="color:#ffffff">Cover image: <b style="color:red">*</b></label>

            <input type="file" class="form-control" name="cover_img" id="cover_image_required" value="{{old('cover_img')}}" required>
            <span id="cover_img_err" class="form-error"></span>

          </div>

         <img id="cover_image" src="" style="display:none">
         <div class="form-group" style="width:100%" >

            <label for="short_description" style="color:#ffffff;">Video URL: <b style="color:red">*</b></label>

           <input type="text" class="form-control" id="video_url" name="video_url"  value="{{old('video_url')}}">
            <span id="video_url_err" class="form-error"></span>

          </div>

            <div class="form-group" style="width:100%" >

            <label for="short_description" style="color:#ffffff;">Short Description: <b style="color:red">*</b></label>

            <textarea class="form-control" maxlength="200" id="short_description" name="short_description" required>{{old('short_description')}}</textarea>
            <span id="short_description_err" class="form-error"></span>

          </div>

          <div class="form-group" style="width:100%">
          <label for="description" style="color:#ffffff;">Description: <b style="color:red">*</b></label>
        <textarea id='description' name="description" required>{{old('description')}}</textarea>
        <span id="description_err" class="form-error"></span>
        </div>

           <div class="form-group">

            <label for="" style="color:#ffffff">Category: <b style="color:red">*</b></label>

            <select ng-model="Video.category" name="category" id="category" class="form-control" required>

              <option value="">-Select-</option>
              <?php $items = \App\Models\VideoCategory::all(['title', 'id']); ?>
              @foreach($items as $item)
                <option value={{$item->id}}>{{$item->title}}</option>
              @endforeach
            </select>
            <span id="category_err" class="form-error"></span>
          </div>
           <div class="form-group">

            <label for="" style="color:#ffffff">Essense: <b style="color:red">*</b></label>

            <select ng-model="Video.category" name="essence" id="essence" class="form-control" required>
              <option value="">-Select-</option>
              <?php $items = \App\Models\VideoEssence::all(['title', 'id']); ?>
              @foreach($items as $item)
                <option value={{$item->id}}>{{$item->title}}</option>
              @endforeach
            </select>
            <span id="essence_err" class="form-error"></span>
          </div>
             <div class="form-group">

            <label for="" style="color:#ffffff">Available for:</label>

            <select ng-model="Video.category" name="isfree" id="isfree" class="form-control">

          <option value="">-Select-</option>

        <option value="0">Subscribed users</option>

        <option value="1">Everyone</option>

        </select>
        <span id="isfree_err" class="form-error"></span>
          </div>
          <div class="form-group" >

            <label for="email" style="color:#ffffff;">Author: </label>

            <input type="text" class="form-control" id="author" name="author" required value="{{old('author')}}">

          </div>

               <div class="form-group">

            <label for="" style="color:#ffffff">Is Visible: <b style="color:red">*</b></label>

            <select name="active" id="visible" class="form-control" required>

          <option value="">-Select-</option>

        <option value="1">Yes</option>

        <option value="0">No </option>

        </select>
        <span id="author_err" class="form-error"></span>
          </div>
          <div class="form-group">

           <div class="checkbox">

            <label style="color:#ffffff"><input type="checkbox" name="recommended" id="recommended" value="1">Recommended article ?</label>
            <span id="recommended_err" class="form-error"></span>
          </div>
          </div>

          <div>

           <button type="submit" class="btn btn-bordered btn-primary mb5" style="margin-left: 90%;">Submit</button>
           </div>
        </form>
              </div>
            </div>
          </div>