<?php
function check_login()
{
     $ci = get_instance();
     if (!$ci->session->userdata('email')) {
          $ci->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Silakan masuk terlebih dahulu.</div>');
          redirect('auth');
     }
}
