<div>
	<x-layout bodyClass="g-sidenav-show  bg-gray-200">
		<x-navbars.sidebar activePage="tag"></x-navbars.sidebar>
		<main class="main-content position-relative max-height-vh-100 h-100 border-radius-md ">
			<x-navbars.navs.auth titlePage='Tags' pageType="show"></x-navbars.navs.auth>

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
							<a class="btn bg-gradient-success mb-0" wire:click="edit()"><i
									class="material-icons text-sm">edit</i>&nbsp;&nbsp;
								{{ __('common.editTitle', ['name' => __('common.Tags')]) }}</a></a>

							<a class="btn bg-gradient-danger dt-delete mb-0" data-key="{{ $tag->id }}"><i
									class="material-icons text-sm">delete</i>&nbsp;&nbsp;
								{{ __('common.delete', ['name' => __('common.Tags')]) }}</a>
						</div>
					</div>
					<div class="card-body px-3 pb-2">
						<div class="row">
							<div class="col-3">
								<label class="text-md">id</label>
							</div>
							<div class="col-9">
								<label class="text-md">{{ $this->tag->id }}</label>
							</div>
						</div>
						<div class="row">
							<div class="col-3">
								<label class="text-md"> {{ __('common.title') }} </label>
							</div>
							<div class="col-9">
								<label class="text-md">{{ $this->tag->title }}</label>
							</div>
						</div>
						<div class="row">
							<div class="col-3">
								<label class="text-md"> {{ __('common.createdAt') }} </label>
							</div>
							<div class="col-9">
								<label class="text-md">{{ $this->tag->created_at }}</label>
							</div>
						</div>
						<div class="row">
							<div class="col-3">
								<label class="text-md"> {{ __('common.updatedAt') }} </label>
							</div>
							<div class="col-9">
								<label class="text-md">{{ $this->tag->updated_at }}</label>
							</div>
						</div>
					</div>
				</div>
				<x-footers.auth></x-footers.auth>

		</main>

	</x-layout>
	<script>
		document.addEventListener('livewire:load', function() {
			$('.dt-delete').click(function(event) {
				Swal.fire({
					icon: 'warning',
					title: `{{ __('common.delete', ['name' => __('common.News')]) }}`,
					text: `{{ __('common.areYouSure') }}`,
					showDenyButton: true,
					confirmButtonColor: '#d9534f',
					denyButtonColor: '#5bc0de',
					confirmButtonText: `{{ __('common.yesDelete') }}`,
					denyButtonText: ` <span class="text-light">{{ __('common.noCancel') }}</span>`,
				}).then((result) => {
					if (result.isConfirmed) {
						let key = $(this).attr('data-key');
						@this.delete(key);
					}
				})
			});
		})
		window.addEventListener('swal', function(e) {
			Swal.fire(e.detail);
		});
	</script>
</div>
