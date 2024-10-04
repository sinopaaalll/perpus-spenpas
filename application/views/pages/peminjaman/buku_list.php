<table class="table table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach (array_values(unserialize($this->session->userdata('cart'))) as $items) { ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $items['name']; ?></td>
                <td><?= $items['options']['penerbit']; ?></td>
                <td><?= $items['options']['tahun_terbit']; ?></td>
                <td style="width:17%">
                    <a href="javascript:void(0)" id="delete_buku<?= $no; ?>" data_<?= $no; ?>="<?= $items['id']; ?>" class="avtar avtar-xs btn-link-secondary">
                        <span class="fa fa-trash"></span></a>
                </td>
            </tr>
            <script>
                $(document).ready(function() {
                    $("#delete_buku<?= $no; ?>").click(function(e) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('peminjaman/del_cart'); ?>",
                            data: 'buku_id=' + $(this).attr("data_<?= $no; ?>"),
                            beforeSend: function() {},
                            success: function(html) {
                                $("#tampil").html(html);
                            }
                        });
                    });
                });
            </script>
        <?php $no++;
        } ?>
    </tbody>
</table>
<?php foreach (array_values(unserialize($this->session->userdata('cart'))) as $items) { ?>
    <input type="hidden" value="<?= $items['id']; ?>" name="idbuku[]">
<?php } ?>
<div id="tampil"></div>