[1mdiff --git a/resources/views/elements/left_sidebar.blade.php b/resources/views/elements/left_sidebar.blade.php[m
[1mindex 54a28b3..15e9ac3 100644[m
[1m--- a/resources/views/elements/left_sidebar.blade.php[m
[1m+++ b/resources/views/elements/left_sidebar.blade.php[m
[36m@@ -62,6 +62,18 @@[m
                         <span>Categorias</span>[m
                     </a>[m
                 </li>[m
[32m+[m[32m                <li class="{{ Request::is('categories*') ? 'active' : '' }}">[m
[32m+[m[32m                    <a href="{{ route('categories.index') }}">[m
[32m+[m[32m                        <i class="material-icons">map</i>[m
[32m+[m[32m                        <span>Areas</span>[m
[32m+[m[32m                    </a>[m
[32m+[m[32m                </li>[m
[32m+[m[32m                <li class="{{ Request::is('categories*') ? 'active' : '' }}">[m
[32m+[m[32m                    <a href="{{ route('categories.index') }}">[m
[32m+[m[32m                        <i class="material-icons">directions</i>[m
[32m+[m[32m                        <span>Direcciones</span>[m
[32m+[m[32m                    </a>[m
[32m+[m[32m                </li>[m
                 <li>[m
                     <a href="javascript:void(0);">[m
                         <i class="material-icons">format_list_bulleted</i>[m
[1mdiff --git a/resources/views/modals/cliente.blade.php b/resources/views/modals/cliente.blade.php[m
[1mdeleted file mode 100644[m
[1mindex d476f90..0000000[m
[1m--- a/resources/views/modals/cliente.blade.php[m
[1m+++ /dev/null[m
[36m@@ -1,72 +0,0 @@[m
[31m-<!-- GUARDAR LOS DATOS DE UN NUEVO CLIENTE -->[m
[31m-<div class="modal fade" id="add" tabindex="-1" role="dialog">[m
[31m-    <div class="modal-dialog modal-lg" role="document">[m
[31m-        <div class="modal-content">[m
[31m-            <div class="modal-header ">[m
[31m-                <h2 class="modal-title" id="deleteLabel">Ingresar datos del nuevo cliente</h2>[m
[31m-                <p>Registre los datos del nuevo cliente</p>[m
[31m-            </div>[m
[31m-            <div class="modal-body">[m
[31m-[m
[31m-                <form method="POST" action="{{ route('clients.store') }}"  role="form">[m
[31m-                    {{ csrf_field() }}[m
[31m-                    <div class="row">[m
[31m-                        <div class="col-md-6">[m
[31m-                            <div class="form-group form-float">[m
[31m-                                <div class="form-line">[m
[31m-                                    <input type="text" class="form-control" name="dni" required>[m
[31m-                                    <label class="form-label">Cedula</label>[m
[31m-                                </div>[m
[31m-                            </div>[m
[31m-                        </div>[m
[31m-                        <div class="col-md-6">[m
[31m-                            <div class="form-group form-float">[m
[31m-                                <div class="form-line">[m
[31m-                                    <select name="area_id"  class="form-control show-tick" data-live-search="true" required> [m
[31m-                                        <option value="">Seleccione</option>[m
[31m-                                    </select> [m
[31m-                                </div>[m
[31m-                            </div>[m
[31m-                        </div>[m
[31m-                        <div class="col-md-6">[m
[31m-                            <div class="form-group form-float">[m
[31m-                                <div class="form-line">[m
[31m-                                    <input type="text" class="form-control" name="first_name" required>[m
[31m-                                    <label class="form-label">Nombres</label>[m
[31m-                                </div>[m
[31m-                            </div>[m
[31m-                        </div>[m
[31m-                        <div class="col-md-6">[m
[31m-                     