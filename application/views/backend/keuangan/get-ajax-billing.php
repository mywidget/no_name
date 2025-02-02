<div id="posts_content">
    <?php if(!empty($tagihan)){ ?>
        <div class="table-responsive">
            <table class="table card-table table-vcenter table-striped text-nowrap datatable" >
                <thead class="thead-dark">
                  	<tr>
                        <th>ID Invoice</th>
                        <th>Tgl Invoice</th>
                        <th>Nomor Siswa</th>
                        <th>Nama Siswa</th>
                        <th>Nominal Tagihan</th>
                        <th>Jurusan</th>
                    </tr>
                </thead>  
                <tbody> 
                    <?php 
                        $no=$this->uri->segment(3)+1;
                        
                        foreach ($tagihan  as $row){
                            
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_invoice']); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal_invoice']); ?></td>
                            <td><?php echo htmlspecialchars($row['nomor_siswa']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo rprp($row['nominal_tagihan']); ?></td>
                            <td><?php echo htmlspecialchars($row['informasi']); ?></td>
                        </tr>
                        <?php $no++;
                        }
                    ?>
                     
                </tbody>  
            </table>  
        </div>
        <div class="card-footer bg-transparent">
            <?php echo $this->ajax_pagination->create_links(); ?>
        </div>
        
        <?php }else{ ?>
        <table class='table table-bordered'>
            <tr>
                <td>Belum ada data</td>
            </tr>
        </table>
    <?php } ?>
</div>
