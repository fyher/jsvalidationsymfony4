# jsvalidationsymfony4
Js validation symfony 4 

use axios 

Example form:


{{ form_start(form,{"attr":{"novalidate":'novalidate',"id":"site"}}) }}
{{ form_row(form.nom) }}
{{ form_row(form.url) }}
{{ form_row(form.favicon.imageFile) }}
{{ form_row(form.logo.imageFile) }}
    {{ form_widget(form) }}
    <button class="btn btn-success btn-block" >{{ button_label|default('Enregistrer') }}</button>
{{ form_end(form) }}


{{ form_extension_js_checker(form,"App-Form-SiteType","site","App-Entity-Site") }}

