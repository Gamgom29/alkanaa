@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="align-items-center">
		<h1 class="h3">{{translate('All Partners')}}</h1>
	</div>
</div>

<div class="row">
	<div class="@if(auth()->user()->can('add_partner')) col-lg-7 @else col-lg-12 @endif">
		<div class="card">
		    <div class="card-header row gutters-5">
				<div class="col text-center text-md-left">
					<h5 class="mb-md-0 h6">{{ translate('Partners') }}</h5>
				</div>
				<div class="col-md-4">
					<form class="" id="sort_partners" action="" method="GET">
						<div class="input-group input-group-sm">
					  		<input type="text" class="form-control" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
						</div>
					</form>
				</div>
		    </div>
		    <div class="card-body">
		        <table class="table aiz-table mb-0">
		            <thead>
		                <tr>
		                    <th>#</th>
		                    <th>{{translate('Name')}}</th>
		                    <th>{{translate('Logo')}}</th>
		                    <th class="text-right">{{translate('Options')}}</th>
		                </tr>
		            </thead>
		            <tbody>
		                @foreach($partners as $key => $partner)
		                    <tr>
		                        <td>{{ ($key+1) + ($partners->currentPage() - 1)*$partners->perPage() }}</td>
		                        <td>{{ $partner->name }}</td>
								<td>
		                            <img src="{{ uploaded_asset($partner->logo) }}" alt="{{translate('Partner')}}" class="h-50px">
		                        </td>
		                        <td class="text-right">
									@can('edit_partner')
										<a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('partners.edit', ['id'=>$partner->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" title="{{ translate('Edit') }}">
											<i class="las la-edit"></i>
										</a>
									@endcan
									@can('delete_partner')
										<a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('partners.destroy', $partner->id)}}" title="{{ translate('Delete') }}">
											<i class="las la-trash"></i>
										</a>
									@endcan
		                        </td>
		                    </tr>
		                @endforeach
		            </tbody>
		        </table>
		        <div class="aiz-pagination">
                	{{ $partners->appends(request()->input())->links() }}
            	</div>
		    </div>
		</div>
	</div>
	@can('add_partner')
		<div class="col-md-5">
			<div class="card">
				<div class="card-header">
					<h5 class="mb-0 h6">{{ translate('Add New Brand') }}</h5>
				</div>
				<div class="card-body">
					<form action="{{ route('partners.store') }}" method="POST">
						@csrf
						<div class="form-group mb-3">
							<label for="name">{{translate('Name')}}</label>
							<input type="text" placeholder="{{translate('Name')}}" name="name" class="form-control" required>
						</div>
						<div class="form-group mb-3">
							<label for="name">{{translate('Logo')}} <small>({{ translate('120x80') }})</small></label>
							<div class="input-group" data-toggle="aizuploader" data-type="image">
								<div class="input-group-prepend">
										<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
								</div>
								<div class="form-control file-amount">{{ translate('Choose File') }}</div>
								<input type="hidden" name="logo" class="selected-files">
							</div>
							<div class="file-preview box sm">
							</div>
                            <small class="text-muted">{{ translate('Minimum dimensions required: 126px width X 100px height.') }}</small>
						</div>
						<div class="form-group mb-3">
							<label for="name">{{translate('Meta Title')}}</label>
							<input type="text" class="form-control" name="meta_title" placeholder="{{translate('Meta Title')}}">
						</div>
						<div class="form-group mb-3">
							<label for="name">{{translate('Meta Description')}}</label>
							<textarea name="meta_description" rows="5" class="form-control"></textarea>
						</div>
						<div class="form-group mb-3 text-right">
							<button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endcan
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
<script type="text/javascript">
    function sort_partners(el){
        $('#sort_partners').submit();
    }
</script>
@endsection
