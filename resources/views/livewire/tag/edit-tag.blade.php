<div>
	<x-layout bodyClass="g-sidenav-show  bg-gray-200">
		<x-navbars.sidebar activePage="tag"></x-navbars.sidebar>
		<main class="main-content position-relative max-height-vh-100 h-100 border-radius-md ">
			<x-navbars.navs.auth titlePage='Tags' pageType="edit"></x-navbars.navs.auth>
			<div class="container-fluid px-2 px-md-4 py-4">
				<div class="card  my-4">
					<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
						<div class="bg-gradient-primary shadow-primary border-radius-md pt-4 pb-3">
							<h6 class="text-white mx-3">
								<strong>
									{{ __('common.Tags') }}
								</strong>
							</h6>
						</div>
					</div>
					<div class=" mx-3 my-3 row">
						<div class="col text-start">
							<a class="btn bg-gradient-info mb-0" wire:click="backToIndex()"><i
									class="material-icons text-sm">keyboard_backspace</i>
							</a>
						</div>
						<div class="col text-end">
							<a class="btn bg-gradient-danger dt-delete mb-0" data-key="{{ $tag->id }}"><i
									class="material-icons text-sm">delete</i>&nbsp;&nbsp;
								{{ __('common.delete', ['name' => __('common.Tags')]) }}</a>
						</div>
					</div>
					<div class="card-body px-3 pb-2">
						<div class="row my-3">
							<div class="col-3">
								<label class="text-md">id</label>
							</div>
							<div class="col-9">
								<div class="input-group   input-group-outline ">
									<input class="form-control " type="number" placeholder="{{ $tag->id }}" disabled>
								</div>
							</div>
						</div>
						<div class="row my-3">
							<div class="col-3">
								<label class="text-md"> {{ __('common.title') }} </label>
							</div>
							<div class="col-9">
								<div class="input-group   input-group-outline ">
									<input class="form-control " type="text" wire:model="tag.title">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-3"></div>
							<div class="col-9">
								<button class="btn btn-primary" type="button" wire:click="save()">
									save
								</button>
							</div>
						</div>
					</div>
				</div>
				<x-footers.auth></x-footers.auth>

		</main>

	</x-layout>

	@push('scripts')
		<script>
			window.addEventListener('swal', function(e) {
				Swal.fire(e.detail);
			});

			document.addEventListener('livewire:load', function() {
				$('.dt-delete').click(function(event) {
					Swal.fire({
						icon: 'warning',
						title: 'Delete',
						text: 'are you sure you want to delete this item ??',
						showDenyButton: true,
						confirmButtonColor: '#d9534f',
						denyButtonColor: '#5bc0de',
						confirmButtonText: 'Yes, delete it!',
						denyButtonText: ` <span class="text-light">No, Cancel.</span>`,
					}).then((result) => {
						if (result.isConfirmed) {
							let key = $(this).attr('data-key');
							@this.delete(key);

						}
					})
				});
			})
		</script>
	@endpush
</div>
