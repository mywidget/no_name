<link href="<?=base_url();?>assets/backend/css/style.css" rel="stylesheet"/>
<div class="page-header d-print-none">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Pengaturan
				</div>
                <h2 class="page-title">
					Menu Admin
				</h2>
			</div>
		</div>
	</div>
</div>
<div class="page-body">
	<div class="container-xl">
		<div class="row row-cards">
			<div class="col-lg-4">
				<!-- Form Basic -->
				<div class="card mb-4">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h3 class="m-0 font-weight-bold text-warning">Tambah Menu</h3>
					</div>
					
					<form id="submit-form">
						<input type="hidden" id="id">
						<!-- form start -->
						<div class="card-body ">
							<div class="form-group tax-wraps mb-2">
								<label class="form-label" for="label">Nama Menu</label>
								<input id="type" type="hidden" value="simpan">
								<input class="form-control" id="label" placeholder="Nama menu" type="text" >
							</div>
							<div class="form-group mb-2">
								<label class="form-label" for="link">URL Menu</label>
								<input class="form-control" id="link" placeholder="URL Menu" type="text"  >
							</div>
							<div class="form-group tax-wrap mb-2">
								<label class="form-label" for="parentc">Parent Class <code>treeview</code></label>
								<input class="form-control" id="parentc" placeholder="treeview" type="text">
							</div>
							<div class="hide-txt mb-2">
								<label class="form-label" for="eclass">CLASS ICON</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
										<i class="fa fa-bars" id="showicon"></i></a>
									</div>
								</div>
								<input class="form-control input1" id="eclass" placeholder="bars" type="text" value="">
								<div class="input-group-append">
									<div class="input-group-text">
										<a href="#" data-toggle="modal" data-target="#myModal">
										<i class="fa fa-search"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group mb-2">
							<label class="form-label" for="target">Target</label>
							<select id="target" class="form-select form-control">
								<option value="_self">Self</option>
								<option value="_blank">Blank</option>
							</select>					
						</div>
						<div class="row  mb-2">
							<div class="col-md-6  mb-2">
								<div class="form-group">
									<label class="form-label" for="aktif">Aktif</label>
									<select id="aktif" class="form-select form-control">
										<option value="">Pilih</option>
										<option value="Y">Ya</option>
										<option value="N">Tidak</option>
									</select>					
								</div>
							</div>
							<div class="col-md-6  mb-2">
								<div class="form-group">
									<label class="form-label" for="submenu">Sub Menu</label>
									<select id="submenu" class="form-select form-control">
										<option value="Y">Ya</option>
										<option value="N" selected>Tidak</option>
									</select>					
								</div>
							</div>
							<div class="col-md-12  mb-2" id="rowLevel">
								<div class="checkbox">
									<input id="select_all" class="minimal" type="checkbox">
									<label for='select_all'> Pilih Level Akses</label>
								</div>
								<?php
									foreach ($result->result_array() as $rowz){
										$dataTz[$rowz['id_parent']][] = $rowz;
									}
									echo checkbox_menu($dataTz, 0, 0, 0);	
								?>
							</div>
						</div>
					</div><!-- /.box-body -->
					
					<div class="card-footer text-end">
						<div class="d-flex">
							<button class="btn btn-success ms-auto" id="submits">Simpan</button> 
						</div>
					</div>
				</form>
				
			</div>
		</div>
		
		<div class="col-lg-8">
			<!-- General Element -->
			<div class="card mb-4">
				<div class="card-header py-0 d-flex flex-row align-items-center justify-content-between">
					<h3 class="m-0 font-weight-bold text-warning">Menu Admin</h3>
					<span id="nestable-menu" class="float-right">
						<button type="button" class="btn btn-success btn-sm" onclick="callFunction(this)" id="kolapse"> Expand</button>
					</span>
				</div>
				<div class="card-body pt-0">
					<div class="cf nestable-listsss">
						<div class="dd" id="nestable">
							<div class="ns-row" id="ns-header">
								<div class="ns-actions-2">#</div>
								<div class="ns-actions">AKSI</div>
								<div class="ns-class">CLASS CSS</div>
								<div class="ns-url">URL</div>
								<div class="ns-title">NAMA MENU</div>
							</div>
							<?php
								
								$query = $this->db->query("select * from menuadmin order by urutan ");
								
								$ref   = [];
								$items = [];
								
								foreach ($query->result() as $data) {
									
									$thisRef = &$ref[$data->idmenu];
									
									$thisRef['idparent'] = $data->idparent;
									$thisRef['nama_menu'] = $data->nama_menu;
									$thisRef['link'] = $data->link;
									$thisRef['class'] = $data->icon;
									$thisRef['treeview'] = $data->treeview;
									$thisRef['idmenu'] = $data->idmenu;
									$thisRef['aktif'] = $data->aktif;
									
									if($data->idparent == 0) {
										$items[$data->idmenu] = &$thisRef;
										} else {
										$ref[$data->idparent]['child'][$data->idmenu] = &$thisRef;
									}
									
								}
								
								
								function get_menu($items,$class = 'dd-list') {
									
									$html = "<ol class=\"".$class."\" id=\"menu-id\">";
									
									foreach($items as $key=>$value) {
										$aktif = '';
										if($value['aktif']=='N'){
											$aktif = 'text-danger';
										}
										$html.= '<li class="dd-item dd3-item '.$aktif.'" data-id="'.$value['idmenu'].'" >
										<div class="dd-handle dd3-handle"></div>
										<div class="ns-row" id="reload_'.$value['idmenu'].'">
										<div class="ns-title" id="label_show'.$value['idmenu'].'">'.$value['nama_menu'].'</div>
										<div class="ns-url" id="link_show'.$value['idmenu'].'">'.$value['link'].'</div>
										<div class="ns-class" id="eclass_show'.$value['idmenu'].'">'.$value['class'].'</div>
										<div class="ns-actions">
										<a class="edit-button" id="'.$value['idmenu'].'"><i class="fa fa-pencil"></i></a>
										<a href="#" class="confirm-delete" data-id="'.$value['idmenu'].'" id="'.$value['idmenu'].'"><i class="fa fa-trash"></i></a>
										</div>
										<div class="ns-actions-2"></div>
										</div>';
										if(array_key_exists('child',$value)) {
											$html .= get_menu($value['child'],'child');
										}
										$html .= "</li>";
									}
									$html .= "</ol>";
									
									return $html;
									
								}
								
								print get_menu($items);
								
							?>
							<input type="hidden" id="nestable-output">
							
						</div>
					</div>
					<div class="form-footer text-end">
						<button id="save" type="button" class="btn btn-success">Simpan</button>
					</div>
				</div>
			</div>
			<!-- Input Group -->
			
		</div>
	</div>
</div>
</div>

<div class="modal modal-blur fade" id="myModalDel" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			<div class="modal-status bg-danger"></div>
			<div class="modal-body text-center py-4">
				<!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
				<svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
				<h3 id="myModalDel">Are you sure?</h3>
				<div class="text-muted">Do you really want to remove data? What you've done cannot be undone.</div>
			<p class="debug-url"></p>
			<input type="hidden" id="data-hapus">
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-dismiss="modal" type="button">Batal</button> 
				<button class="btn btn-danger danger" id="btnYes"  type="button">YA</button> 
			</div>
		</div>
	</div>
</div>
 
<script src="<?= base_url('assets/'); ?>backend/js/jquery.nestable.js" type="text/javascript"></script>
<script src="<?= base_url('assets/'); ?>backend/js/addon.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		
		$('#select_all').on('click',function(){
			if(this.checked){
				$('.get_value').each(function(){
					this.checked = true;
				});
				}else{
				$('.get_value').each(function(){
					this.checked = false;
				});
			}
		});
		
		$('.get_value').on('click',function(){
			if($('.get_value:checked').length == $('.get_value').length){
				$('#select_all').prop('checked',true);
				}else{
				$('#select_all').prop('checked',false);
			}
		});
	});
	</script>											