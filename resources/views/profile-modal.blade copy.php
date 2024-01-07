
<!-- Modal -->
<div class='modal fade modal_' id='tgProfile_Pic' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class="modal-header">
                <h5 class="modal-title">Cambiar foto de perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class='modal-body no-padding'>
                <form class='form-horizontal' method='post' id='mform_Profile_Pic' name='mform_Profile_Pic'
                    enctype='multipart/form-data'>
                    <input type='hidden' name='md'>
                    <input name='_picture' id='_picture' style='display:none;' type='file'>
                    <div class='col-md-12' style='margin: 5px auto;'>
                        <button type='button' class='btn btn-primary w-100 rounded-0 btnpp'>
                            Selecione uma foto
                        </button>
                    </div>
                    <div class='col'>
                        <div id='_pictureProfileIMG' style='margin:0px auto; max-width: 400px;'>
                        </div>
                    </div>
            </div>
            <div class='modal-footer'>
                <button id='picbtn' name='Profile_Pic' type='button' role='button'
                    class='btn btn-secondary picbtn'>
                    <i class='fa fa-ok'></i>
                    Confirmar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

