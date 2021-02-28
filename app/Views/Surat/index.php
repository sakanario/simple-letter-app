<?=$this->extend('layout/template')?>


<?=$this->section('content')?>





<div class="container my-3">
    
    <!-- Button trigger modal -->

    <div class="w-100 d-inline-flex p-2 bd-highlight">
        <h1 class="flex-grow-1" >Daftar Permintaan Surat</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Buat Permintaan Baru
        </button>
    </div>
        <hr>
    <div class="table-responsive">  

        <table class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">No Surat</th>
                <th scope="col">Nama</th>
                <th scope="col">Jurusan</th>
                <th scope="col">NIM</th>
                <th scope="col">No Anggota</th>
                <th scope="col">Alamat</th>
                <th scope="col">Opsi</th>

                </tr>
            </thead>
            <tbody class="">
            
            <!-- looping data surat  -->
            <?php
            $count = 1;
            foreach ($letters as $letter) : ?>
                <tr>
                    <th scope="row"><?=$count;?></th>
                    <td><?=$letter['NO_SURAT']?></td>

                    <td><?=$letter['NAMA']?></td>
                    <td><?=$letter['JURUSAN']?></td>
                    <td><?=$letter['NIM']?></td>
                    <td><?=$letter['NO_ANGGOTA']?></td>
                    <td><?=$letter['ALAMAT']?></td>
                    <td>
                        <div class="d-flex">
                            <?php $linkCetak = base_url().'/surat/cetak/'.$letter['LETTER_ID']?>
                            <button type="button" class="btn btn-primary m-1" onclick=" window.open('<?=$linkCetak?>','_blank')"><i class="fa fa-print" aria-hidden="true"></i></button>
                            <?php $linkDelete = base_url().'/surat/delete/'.$letter['LETTER_ID']?>
                            <button type="button" class="btn btn-danger m-1"  onclick="location.href='<?=$linkDelete?>'"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </div>
                    </td>
                </tr>
            <?php
            $count +=1;
            endforeach;?>
                
            </tbody>
        </table>
    </div> 
       
    
</div>

<?=$this->include('Surat/modalForm')?>



<?=$this->endSection()?>
