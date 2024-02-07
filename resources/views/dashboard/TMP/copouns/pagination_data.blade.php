<div class="card-body table-responsive card-dashboard" style="transition: all 1s;">
    <table
        class="table w-100 text-center display nowrap table-bordered scroll-vertical">
        <thead>
        <tr>
            <th>الكود</th>
            <th>القيمه (%)</th>
            <th>{{ __('admin/forms.max_price') }}</th>
            <th>عدد المستخدمين</th>
            <th>{{ __('admin/forms.max_users') }}</th>
            <th>تاريخ الانشاء</th>
            <th>{{ __('admin/forms.expire_date') }}</th>
            <th>عمليات</th>
        </tr>
        </thead>
        <tbody>
            
            @foreach($copouns as $copoun)
                <tr>
                    <td class="text-info">{{$copoun->code}}</td>
                    <td><span class="badge badge-warning">{{$copoun->max_price}}</span></td>
                    <td><span class="badge badge-success">{{$copoun->value}}</span></td>
                    <td><span class="badge badge-info">{{$copoun->user_copouns()->count()}}</span></td>
                    <td><span class="badge badge-warning">{{$copoun->max_users}}</span></td>
                    <td>{{$copoun->created_at}}</td>
                    <td>{{$copoun->expire_date}}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{route('admin.copouns.edit', ['id'=> $copoun->id ])}}"
                               class="btn btn-info box-shadow-3 mr-1 "><i class="ft-edit"></i></a>

                            <a href="{{route('admin.copouns.delete',$copoun->id)}}" class="delete btn btn-danger box-shadow-3"><i class="ft-delete"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
    <div class="justify-content-center d-flex">
        {!! $copouns->appends(Request::except('page'))->render() !!}
    </div>
</div>