@extends('backend.layouts.main')

@section('title', 'Users')
@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Short Link Details</h5>
                <div class="row">
                    <div class="col-md-6">
                        <dl class="row mt-2">
                            <dt class="col-sm-3">Name</dt>
                            <dd class="col-sm-9">
                                : &nbsp;&nbsp;{{ $link->name }}
                            </dd>

                            <dt class="col-sm-3">Short Link</dt>
                            <dd class="col-sm-9">
                                : &nbsp;&nbsp;<a target="_blank" href="{{url('').'/'.$link->main_link}}">{{ url('').'/'.$link->main_link }}</a>
                                <a type="button" onclick="copyLink('{{url('').'/'.$link->main_link}}')" class="align-bottom waves-effect">
                                    <i class="tf-icons mdi mdi-content-copy"></i>
                                </a>
                            </dd>

                            <dt class="col-sm-3">Description</dt>
                            <dd class="col-sm-9">
                                : &nbsp;&nbsp;{{ ($link->description == null) ? 'N/A' : $link->description }}
                            </dd>

                            <dt class="col-sm-3">Type</dt>
                            <dd class="col-sm-9">
                                : &nbsp;&nbsp;{{ ucwords($link->type) }}
                            </dd>

                            <dt class="col-sm-3">Clicks</dt>
                            <dd class="col-sm-9">
                                : &nbsp;&nbsp;{{ $total_click }}
                            </dd>

                            <dt class="col-sm-3 text-truncate">Created At :</dt>
                            <dd class="col-sm-9">
                                : &nbsp;&nbsp;{{ date('d M, Y h:i:s A', strtotime($link->created_at)) }}
                            </dd>

                            <dt class="col-sm-3 text-truncate">Last Click :</dt>
                            <dd class="col-sm-9">
                                : &nbsp;&nbsp;{{ date('d M, Y h:i:s A', strtotime($link->updated_at)) }}
                            </dd>
                        </dl>
                    </div>
                    <div class="col-md-12">
                        <h5>Redirect Links</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Link</th>
                                        <th>Click</th>
                                        <th>Percent</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($links_details as $index=>$links_detail)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $links_detail->link }}</td>
                                        <td>{{ $links_detail->click }}</td>
                                        <td>{{ $links_detail->percent }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
@push('js')
    <script>
        function copyLink(text){
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            alert('Text copied');
            document.body.removeChild(textarea);
        }
    </script>
@endpush