
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	<div class="modal-content" style="background-color: #fafdfb; width: 100%;">
		<div class="modal-header" style="padding-bottom: 5px;">
			{{-- {{ dd($_POST) }} --}}
			<h5 class="modal-title" id="exampleModalLongTitle">{{ $_GET['head'] }}</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>

		<div class="modal-body" style="padding-left: 0px; padding-right: 0px;">
			<iframe class="" src="{{ $_GET['href'] }}" style="height: 70vh; width: 100%;" frameborder="0"></iframe>
		</div>

		<!-- <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 			<button type="button" class="btn btn-primary">Save changes</button>
		</div> -->
	</div>
</div>
