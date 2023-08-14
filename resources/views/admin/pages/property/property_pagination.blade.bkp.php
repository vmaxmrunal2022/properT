<table class="table table-striped dt-responsive nowrap data-table" style="width:100%">
    <thead>
        <tr>
            <th>Sl.no</th>
            <th>Date </th>
            <th>Time </th>
            <th>GIS ID</th>
            <th>Category of the property</th>
            <th>House No.</th>
            <th>Colony/Locality Name</th>
            <th>Owner Full Name</th>
            <th>Street Details</th>
            <!--<th>Pincode</th>-->
            <th>No Of Floors</th>
            <th>Images</th>
            <th>Remarks</th>
            <th class="noExport">Action</th>
        </tr>
    </thead>
    <!--12. Type-->
    <tbody>
        @foreach ($properties as $property)
            <tr>
                <td>{{ $loop->iteration ?? 'N/A' }}</td>
                <td>{{ $property->date ?? 'N/A' }}</td>
                <td>{{ $property->time ?? 'N/A' }}</td>
                <td>{{ $property->gis_id ?? 'N/A' }} </td>
                <td>{{ $property->cat ?? 'N/A' }}</td>
                <td>{{ $property->house_no ?? 'N/A' }}</td>
                <td>{{ $property->locality_name ?? 'N/A' }}</td>
                <td>{{ $property->owner_name ?? 'N/A' }} </td>
                <td>{{ $property->street_details ?? 'N/A' }}</td>
                <!--<td>N/A</td>-->
                <td>{{ $property->no_of_floors ?? 'N/A' }}</td>
                <td>
                    <div class="row justify-content-around">
                        @forelse ($property->images->take(1) as $image)
                            <!--<div class="colx img-max"><img src="{{ asset('uploads/property/images/' . $image->file_url) }}" alt="" height="80px"  class="img-fluid"></div>-->
                            
                                    @php 
                                        $extension = pathinfo($image->file_url, PATHINFO_EXTENSION);
                                    @endphp
                                    
                                    @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'], true))
                                    <a data-fancybox="gallery"  class=""><img src="{{ asset('uploads/property/images/' . $image->file_url) }}"
                                    alt="" height="120px" class=""></a>
                                    @elseif($extension == 'pdf')
                                    <a data-fancybox="gallery" href="{{ asset('uploads/property/images/' . $image->file_url) }}">
                                        <img src="{{ asset('assets/images/svg/default-pdf.svg') }}" class="img-fluid">
                                    </a>
                                    @endif
                        @empty
                            N/A
                        @endforelse

                    </div>
                </td>
                <td>{{ $property->remarks ?? '' }}</td>
                <td class="noExport">
                    <a target="_blank" href=" {{ route('surveyor.property.report_details', $property->id) }} ">
                        <button class="btn btn-sm btn-primary">
                            View more
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
<div id="pagination">
    {{ $properties->links('pagination::bootstrap-4', ['secure' => true]) }}
    <!--{{ $properties->links() }}-->
</div>
