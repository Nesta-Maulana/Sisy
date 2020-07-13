

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Rpd Filling</title>
    <style>
        .thead
        {
            font-size: 13px;
            background-color: darkgrey;
        }
    </style>
</head>
<body>
    <table class="table table-bordered text-center" id="report-rpd-filling">
        <thead>
            <tr>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black">Nomor&nbsp;&nbsp;&nbsp;&nbsp;Wo</th>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black">Nama Produk</th>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black">Tanggal Produksi</th>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black">Mesin Filling</th>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black">Sampel</th>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black">Tanggal Filling</th>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black">Jam Filling</th>
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Berat Kanan </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Berat Kiri </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Overlap </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Ls Sa Proportion </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Volume Kanan </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Volume Kiri </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Airgap </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Ts Accurate Kanan </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Ts Accurate Kiri </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Ls Accurate </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Sa Accurate </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Surface Check </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Pinching </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Strip Folding </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Konduktivity Kanan </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Konduktivity Kiri </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Design Kanan </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Design Kiri </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Dye Test </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Residu H2o2 </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Prod Code and No Md </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Correction </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Dissolving Test </th> 
                <th style="background-color: #9c9494;font-size:13px;border:1px solid black"> Status Akhir </th> 
            </tr>
        </thead>
        <tbody id="isi-report-rpd-filling">
            <?php $__currentLoopData = $woNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $woNumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $woNumber->rpdFillingHead->rpdFillingDetailPis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rpdFillingDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->woNumber->wo_number); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->woNumber->product->product_name); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->woNumber->production_realisation_date); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->fillingMachine->filling_machine_code); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->fillingSampelCode->filling_sampel_code.' - '.$rpdFillingDetail->fillingSampelCode->filling_sampel_event); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->filling_date); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->filling_time); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->berat_kanan); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->berat_kiri); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->overlap); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->ls_sa_proportion); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->volume_kanan); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->volume_kiri); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->airgap); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->ts_accurate_kanan); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->ts_accurate_kiri); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->ls_accurate); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->sa_accurate); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->surface_check); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->pinching); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->strip_folding); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->konduktivity_kanan); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->konduktivity_kiri); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->design_kanan); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->design_kiri); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->dye_test); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->residu_h2o2); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->prod_code_and_no_md); ?></td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->correction); ?></td>
                        <td style="border:1px solid black">
                            <?php if(is_null($rpdFillingDetail->dissolving_test)): ?>
                            -
                            <?php else: ?>
                            <?php echo e($rpdFillingDetail->dissolving_test); ?>

                            <?php endif; ?>
                        </td>
                        <td style="border:1px solid black"><?php echo e($rpdFillingDetail->status_akhir); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH C:\xampp\htdocs\Sisy\resources\views/rollie/reports/rpd_filling/export.blade.php ENDPATH**/ ?>