<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">


<!-- borderTest -->
<!-- @ extends(' layouts.app')

@ section('contenu')

@ endsection -->



<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{  asset('styles/js/bootstrap_4_5_0.min.js')  }}"></script>
<script type="text/javascript" src="{{  asset('styles/js/jQuery v3.5.1.min.js')  }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('styles/bootstrap/bootstrap_4_5_0.min.css') }}">
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('styles/fontawesome/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/style.css') }}"> -->

<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="http://localhost/site-etu-tp/public/styles/bootstrap/bootstrap_4_5_0.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://localhost/site-etu-tp/public/styles/fontawesome/css/all.css">
<script src="http://localhost/site-etu-tp/public/styles/js/ajax_2_2_0_jquery.min.js"></script>
<!-- <script src="http://localhost/site-etu-tp/public/styles/js/jquery3.4.1.js"></script> -->
<!-- <script src="http://localhost/site-etu-tp/public/styles/js/jquery-3.5.1.min.js"></script> -->
<script src="http://localhost/site-etu-tp/public/styles/js/popper.min.js"></script>
<!-- <script src="http://localhost/site-etu-tp/public/styles/js/popper_1_16.min.js"></script> -->
<script src="http://localhost/site-etu-tp/public/styles/js/bootstrap_4_5_0.min.js"></script>

<!-- 

<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
<style>
body {
	color: #566787;
	background: #f5f5f5;
	font-family: 'Varela Round', sans-serif;
	font-size: 13px;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
	background: #fff;
	padding: 20px 25px;
	border-radius: 3px;
	min-width: 1000px;
	box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {        
	padding-bottom: 15px;
	background: #435d7d;
	color: #fff;
	padding: 16px 30px;
	min-width: 100%;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}
.table-title h2 {
	margin: 5px 0 0;
	font-size: 24px;
}
.table-title .btn-group {
	float: right;
}
.table-title .btn {
	color: #fff;
	float: right;
	font-size: 13px;
	border: none;
	min-width: 50px;
	border-radius: 2px;
	border: none;
	outline: none !important;
	margin-left: 10px;
}
.table-title .btn i {
	float: left;
	font-size: 21px;
	margin-right: 5px;
}
.table-title .btn span {
	float: left;
	margin-top: 2px;
}
table.table tr th, table.table tr td {
	border-color: #e9e9e9;
	padding: 12px 15px;
	vertical-align: middle;
}
table.table tr th:first-child {
	width: 60px;
}
table.table tr th:last-child {
	width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
	background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
	background: #f5f5f5;
}
table.table th i {
	font-size: 13px;
	margin: 0 5px;
	cursor: pointer;
}	
table.table td:last-child i {
	opacity: 0.9;
	font-size: 22px;
	margin: 0 5px;
}
table.table td a {
	font-weight: bold;
	color: #566787;
	display: inline-block;
	text-decoration: none;
	outline: none !important;
}
table.table td a:hover {
	color: #2196F3;
}
table.table td a.edit {
	color: #FFC107;
}
table.table td a.delete {
	color: #F44336;
}
table.table td i {
	font-size: 19px;
}
table.table .avatar {
	border-radius: 50%;
	vertical-align: middle;
	margin-right: 10px;
}
.pagination {
	float: right;
	margin: 0 0 5px;
}
.pagination li a {
	border: none;
	font-size: 13px;
	min-width: 30px;
	min-height: 30px;
	color: #999;
	margin: 0 2px;
	line-height: 30px;
	border-radius: 2px !important;
	text-align: center;
	padding: 0 6px;
}
.pagination li a:hover {
	color: #666;
}	
.pagination li.active a, .pagination li.active a.page-link {
	background: #03A9F4;
}
.pagination li.active a:hover {        
	background: #0397d6;
}
.pagination li.disabled i {
	color: #ccc;
}
.pagination li i {
	font-size: 16px;
	padding-top: 6px
}
.hint-text {
	float: left;
	margin-top: 10px;
	font-size: 13px;
}    
/* Custom checkbox */
.custom-checkbox {
	position: relative;
}
.custom-checkbox input[type="checkbox"] {    
	opacity: 0;
	position: absolute;
	margin: 5px 0 0 3px;
	z-index: 9;
}
.custom-checkbox label:before{
	width: 18px;
	height: 18px;
}
.custom-checkbox label:before {
	content: '';
	margin-right: 10px;
	display: inline-block;
	vertical-align: text-top;
	background: white;
	border: 1px solid #bbb;
	border-radius: 2px;
	box-sizing: border-box;
	z-index: 2;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
	content: '';
	position: absolute;
	left: 6px;
	top: 3px;
	width: 6px;
	height: 11px;
	border: solid #000;
	border-width: 0 3px 3px 0;
	transform: inherit;
	z-index: 3;
	transform: rotateZ(45deg);
}
.custom-checkbox input[type="checkbox"]:checked + label:before {
	border-color: #03A9F4;
	background: #03A9F4;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
	border-color: #fff;
}
.custom-checkbox input[type="checkbox"]:disabled + label:before {
	color: #b8b8b8;
	cursor: auto;
	box-shadow: none;
	background: #ddd;
}
/* Modal styles */
.modal .modal-dialog {
	max-width: 400px;
}
.modal .modal-header, .modal .modal-body, .modal .modal-footer {
	padding: 20px 30px;
}
.modal .modal-content {
	border-radius: 3px;
	font-size: 14px;
}
.modal .modal-footer {
	background: #ecf0f1;
	border-radius: 0 0 3px 3px;
}
.modal .modal-title {
	display: inline-block;
}
.modal .form-control {
	border-radius: 2px;
	box-shadow: none;
	border-color: #dddddd;
}
.modal textarea.form-control {
	resize: vertical;
}
.modal .btn {
	border-radius: 2px;
	min-width: 100px;
}	
.modal form label {
	font-weight: normal;
}	
</style>
<script>
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});


</script>
</head>
<body>

<!-- Tableau -->
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Gestion des <b>Années</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#ajoutAnneeModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus"></i> <span>Ajouter année</span></a>
						<a href="#deleteAnneeModal" class="btn btn-danger" data-toggle="modal"><i class="fas fa-minus"></i> <span>Supprimer</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>Libelle</th>
						<th>Etat</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
						</td>
						<td>2022-2023</td>
						<td>Active</td>
						<td>
							<a href="#ModiffeAnneeModal" onclick='Modif_annee("id", "2022-2023")' class="edit fas fa-edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" ></i></a>
							<a href="#deleteAnneeModal" onclick='Sup_annee("id","2022-2023")' class="delete fas fa-trash-alt" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete"></i></a>
						</td>
					</tr>

				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
				<ul class="pagination">
					<li class="page-item disabled"><a href="#">Previous</a></li>
					<li class="page-item"><a href="#" class="page-link">1</a></li>
					<li class="page-item"><a href="#" class="page-link">2</a></li>
					<li class="page-item active"><a href="#" class="page-link">3</a></li>
					<li class="page-item"><a href="#" class="page-link">4</a></li>
					<li class="page-item"><a href="#" class="page-link">5</a></li>
					<li class="page-item"><a href="#" class="page-link">Next</a></li>
				</ul>
			</div>
		</div>
	</div>        
</div>

<!-- Edit Modal HTML creation-->
<div id="ajoutAnneeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
        <form action="{{route('config.store')}}" method="POST">
            @csrf
				<div class="modal-header">						
					<h4 class="modal-title">Ajouter une année universitaire</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<b>Année universitaire:</b>
						<input type="text" name="modal_annee"  class="form-control" required id="" placeholder="2022-2023">
					</div>

					<div class="form-group">
						<b>Etat:</b>
						<select class="form-control" required name="etat" id="modale_etat_anne">
							<option value="" ></option>
							< ?php foreach ($listeService as $service): ?>
							<option value="Active">Active</option>
							<option value="Inactive">Inactive</option>
							< ?php endforeach ?>
						</select>					</div>

				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
				</div>


			</form>
		</div>
	</div>
</div>



<!-- Edit Modal HTML -->
<div id="ModiffeAnneeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
        <form action="{{route('config.store')}}" method="POST">
            @csrf
				<div class="modal-header">						
					<h4 class="modal-title">Modiffier une année universitaire</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">


					<div class="form-group">
						<b>Libelle Année :</b>
						<input type="text" name="modal_annee"  class="form-control" required id="modale_libelle_annee">
					</div>
					<div class="form-group">
						<b>Etat:</b>
						<select class="form-control" required name="etat" id="modale_etat_anne">
							<option value="" ></option>
							< ?php foreach ($listeService as $service): ?>
							<option value="Active">Active</option>
							<option value="Inactive">Inactive</option>
							< ?php endforeach ?>
						</select>
					</div>

				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Retour">
					<input type="submit" class="btn btn-info" value="Modiffier">
				</div>


			</form>
		</div>
	</div>
</div>






<!-- Delete Modal HTML -->
<div id="deleteAnneeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Suppression Année</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p id="supp_anne">Êtes-vous sûr de vouloir supprimer ?</p>
					<p class="text-warning"><small>Cette action est irevercive.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Retour">
					<input type="submit" class="btn btn-danger" value="Supprimer">
				</div>
			</form>
		</div>
	</div>
</div>



</body>

<script type="text/javascript">
	

function Modif_annee(id,annee,etat){
    console.log("dddddddddddddddddddddddddd");
    var input_libelle = document.getElementById('modale_libelle_annee');
    var input_etat = document.getElementById('modale_etat_anne');
    input_libelle.value = annee;
    input_etat.value = etat;
}
	

function Sup_annee(id,annee){
    var input_supp_anne = document.getElementById('supp_anne');
    input_supp_anne.innerHTML = "Êtes-vous sûr de vouloir supprimer "+annee+" ?";
}
	





function Af_nom(nom){
    console.log("dddddddddddddddddddddddddd");
    var input_nom = document.getElementById('modale_nom');
    input_nom.value = nom;
}
	

function Af_nom(nom){
    console.log("dddddddddddddddddddddddddd");
    var input_nom = document.getElementById('modale_nom');
    input_nom.value = nom;
}

</script>

</html>