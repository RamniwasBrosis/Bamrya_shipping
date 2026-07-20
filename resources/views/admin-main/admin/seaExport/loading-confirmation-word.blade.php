<h2>Loading Confirmation Report</h2>

<table>
    <tr><th>Job No.</th><td>{{ $seaExport->jobMaster->job_no ?? '' }}</td></tr>
    <tr><th>HBL No.</th><td>{{ $seaExport->hbl_no ?? '' }}</td></tr>
    <tr><th>MBL No.</th><td>{{ $seaExport->mbl_no ?? '' }}</td></tr>
    <tr><th>Shipper</th><td>{{ $seaExport->shipperName->party_name ?? '' }}</td></tr>
    <tr><th>Consignee / Notify</th><td>{{ $seaExport->ConsigneeName->party_name ?? '' }}</td></tr>
    <tr><th>Customer Invoice No.</th><td>{{ $seaExport->customer_inv_no ?? '' }}</td></tr>
    <tr><th>S/Bill No. / Date</th><td>{{ $seaExport->sbill_no ?? '' }}</td></tr>
    <tr><th>No. of Packages</th><td>{{ $seaExport->container->total_package ?? '' }}</td></tr>
    <tr><th>CBM</th><td>{{ $seaExport->cbm ?? '' }}</td></tr>
    <tr><th>NT / GR WT</th><td>{{ ($seaExport->net_weight ?? '') . ' / ' . ($seaExport->gross_weight ?? '') }}</td></tr>
    <tr><th>POD / FPOD</th><td>{{ ($seaExport->dischargePortName->port_name ?? '') . ' / ' . ($seaExport->deliveryPortName->port_name ?? '') }}</td></tr>
    <tr><th>VSL / VOY</th><td>{{ ($seaExport->vessel_name ?? '') . ' / ' . ($seaExport->voyage_no ?? '') }}</td></tr>
    <tr><th>Load Port</th><td>{{ $seaExport->loadingPortName->port_name ?? '' }}</td></tr>
    <tr><th>ETD / SAIL ON Date</th><td>{{ $seaExport->etd_date ? \Carbon\Carbon::parse($seaExport->etd_date)->format('d/m/Y') : '' }}</td></tr>
    <tr><th>SOB</th><td>{{ $seaExport->sob_date ? \Carbon\Carbon::parse($seaExport->sob_date)->format('d/m/Y') : '' }}</td></tr>
</table>

@if($seaExport->container)
<h3>Container Details</h3>
<table>
    <tr>
        <th>Container No</th>
        <th>Custom Seal No</th>
        <th>Agent Seal No</th>
        <th>Size</th>
        <th>Container Type</th>
    </tr>
    <tr>
        <td>{{ $seaExport->container->container_no }}</td>
        <td>{{ $seaExport->container->cust_seal_no }}</td>
        <td>{{ $seaExport->container->agent_seal_no }}</td>
        <td>{{ $seaExport->container->size }}</td>
        <td>{{ $seaExport->container->fcl_lcl }}</td>
    </tr>
@endif
</table>
