<?php
class Form {
    /**
     * Class Form ini berfungsi sebagai helper untuk memudahkan 
     * pembuatan elemen-elemen form HTML.
     * * Meskipun class ini di-include di index.php, 
     * namun fitur autentikasi tidak menggunakan method-method di dalamnya.
     * * Anda dapat menambahkan method-method seperti:
     * - public function input_text($name, $label, $value = '')
     * - public function select($name, $label, $options = [])
     */
     
     // Contoh method sederhana:
     public function input_text($name, $label, $value = '') {
         $html = '<div class="mb-3">';
         $html .= '<label for="' . $name . '" class="form-label">' . $label . '</label>';
         $html .= '<input type="text" name="' . $name . '" id="' . $name . '" value="' . $value . '" class="form-control">';
         $html .= '</div>';
         return $html;
     }

}
?>