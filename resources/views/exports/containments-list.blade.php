<table>
    <thead>
    <tr>
        <th align="right" width="20"><h1><strong>Containment Code</strong></h1></th>
        <th align="right" width="20"><h1><strong>Containment Type</strong></h1></th>
        <th align="right" width="20"><h1><strong>Tank Length (m)</strong></h1></th>
        <th align="right" width="20"><h1><strong>Tank Width (m)</strong></h1></th>
        <th align="right" width="20"><h1><strong>Depth (m)</strong></h1></th>
        <th align="right" width="20"><h1><strong>Pit Diameter (m)</strong></h1></th>
        <th align="right" width="20"><h1><strong>Containment Volume (m³)</strong></h1></th>
        <th align="right" width="20"><h1><strong>Containment Location</strong></h1></th>
        <th align="right" width="20"><h1><strong>Septic Tank Standard Compliance</strong></h1></th>
        <th align="right" width="20"><h1><strong>Construction Date</strong></h1></th>
        <th align="right" width="20"><h1><strong>Emptied Status</strong></h1></th>
        <th align="right" width="20"><h1><strong>Last Emptied Date</strong></h1></th>
        <th align="right" width="20"><h1><strong>Next Emptying Date</strong></h1></th>
        <th align="right" width="20"><h1><strong>Number of Times Emptied</strong></h1></th>
        <th align="right" width="20"><h1><strong>Responsible BIN</strong></h1></th>
    </tr>
    </thead>
    <tbody>
    @foreach($containmentResults as $containment)
        <tr>
            <td>{{ $containment->id  }}</td>
            <td>{{ $containment->containment_type  }}</td>
            <td>{{ $containment->tank_length  }}</td>
            <td>{{ $containment->tank_width  }}</td>
            <td>{{ $containment->depth  }}</td>
            <td>{{ $containment->pit_diameter  }}</td>
            <td>{{ $containment->size  }}</td>
            <td>{{ $containment->location  }}</td>
            <td>{{ $containment->septic_criteria  }}</td>
            <td>{{ $containment->construction_date  }}</td>
            <td>{{  is_null($containment->emptied_status)
                ? ''
                : ($containment->emptied_status === true ? 'Yes' : 'No') }} </td>
            <td>{{ $containment->last_emptied_date  }}</td>
            <td>{{ $containment->next_emptying_date  }}</td>
            <td>{{ $containment->no_of_times_emptied  }}</td>
            <td>{{ $containment->responsible_bin  }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
