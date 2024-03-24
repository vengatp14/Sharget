<?php $this->load->view('common/header'); ?>

  <div class="row p-5">

    <div class="col-lg-10 col-md-10 col-sm-12 mt-5 mt-lg-0 mx-auto">
        <h1 class="bg-info p-2 text-center text-white rounded">chat</h1>
        <main class="main-scroll" style="overflow-x: hidden; overflow-y: scroll; height: 420px;">

          <div class="d-flex flex-row justify-content-start p-1">
            <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-chat/ava6-bg.png"
              alt="avatar 1" style="width: 45px; height: 100%;">
            <div>
              <p style="background-color: skyblue;" class="small p-2 ms-3 mb-1 rounded-3  text-white" >Lorem ipsum dolor
                sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua.</p>
              <p class="small ms-3 mb-3 rounded-3 text-muted float-end">12:00 PM | Aug 13</p>
            </div>
          </div>

          <div class="d-flex flex-row justify-content-end p-1">
            <div>
              <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-info">Ut enim ad minim veniam, quis
                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              <p class="small me-3 mb-3 rounded-3 text-muted">12:00 PM | Aug 13</p>
            </div>
            <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-chat/ava1-bg.png"
              alt="avatar 1" style="width: 45px; height: 100%;">
          </div>

          <div class="d-flex flex-row justify-content-start p-1">
            <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-chat/ava6-bg.png"
              alt="avatar 1" style="width: 45px; height: 100%;">
            <div>
              <p style="background-color: skyblue;" class="small p-2 ms-3 mb-1 rounded-3 text-white" >Lorem ipsum dolor
                sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua.</p>
              <p class="small ms-3 mb-3 rounded-3 text-muted float-end">12:00 PM | Aug 13</p>
            </div>
          </div>

          <div class="d-flex flex-row justify-content-end p-1 ">
            <div>
              <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-info">Ut enim ad minim veniam, quis
                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              <p class="small me-3 mb-3 rounded-3 text-muted">12:00 PM | Aug 13</p>
            </div>
            <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-chat/ava1-bg.png"
              alt="avatar 1" style="width: 45px; height: 100%;">
          </div>

          <div class="d-flex flex-row justify-content-start p-1">
            <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-chat/ava6-bg.png"
              alt="avatar 1" style="width: 45px; height: 100%;">
            <div>
              <p style="background-color: skyblue;" class="small p-2 ms-3 mb-1 rounded-3 text-white" >Lorem ipsum dolor
                sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua.</p>
              <p class="small ms-3 mb-3 rounded-3 text-muted float-end">12:00 PM | Aug 13</p>
            </div>
          </div>

          <div class="d-flex flex-row justify-content-end p-1">
            <div>
              <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-info">Ut enim ad minim veniam, quis
                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              <p class="small me-3 mb-3 rounded-3 text-muted">12:00 PM | Aug 13</p>
            </div>
            <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-chat/ava1-bg.png"
              alt="avatar 1" style="width: 45px; height: 100%;">
          </div>

          <div class="d-flex flex-row justify-content-start p-1">
            <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-chat/ava6-bg.png"
              alt="avatar 1" style="width: 45px; height: 100%;">
            <div>
              <p style="background-color: skyblue;" class="small p-2 ms-3 mb-1 rounded-3 text-white" >Lorem ipsum dolor
                sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua.</p>
              <p class="small ms-3 mb-3 rounded-3 text-muted float-end">12:00 PM | Aug 13</p>
            </div>
          </div>

          <div class="d-flex flex-row justify-content-end p-1">
            <div>
              <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-info">Ut enim ad minim veniam, quis
                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              <p class="small me-3 mb-3 rounded-3 text-muted">12:00 PM | Aug 13</p>
            </div>
            <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-chat/ava1-bg.png"
              alt="avatar 1" style="width: 45px; height: 100%;">
          </div>
        </main>
        <div class="input-group ">
          <input type="text" class="form-control" placeholder="type you message" aria-label="Username" aria-describedby="basic-addon1">
          <span style="cursor: pointer;" class="input-group-text text-white bg-info" id="basic-addon1">send</span>

          <!-- <span style="cursor: pointer;" id="uploadFile" type="file" class="input-group-text text-white bg-primary" id="basic-addon1"><i class="far fa-image"></i></span> -->
        <span>
            <input type="file"  id="upload" hidden/>
          <label  class="labbel-hidden bg-info" for="upload"><i class="fas fa-paperclip"></i></label>
        </span>
        </div>
    </div>
  </div>

<?php $this->load->view('common/footer'); ?>