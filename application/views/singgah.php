                            <?php foreach ($upah as $b) : ?>
                                <tr>
                                    <td scope="col" class="col-1 text-center">
                                        <small>
                                            <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                                <?= $b->kode_upah ?>
                                            </span>
                                        </small>
                                    </td>
                                    <td scope="col" class="col-3 text-start">
                                        <small>
                                            <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                                <?= $b->uraian_upah ?>
                                            </span>
                                        </small>
                                    </td>
                                    <td scope="col" class="col-2 text-start">
                                        <small>
                                            <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                                <?= $b->satuan_upah ?>
                                            </span>
                                        </small>
                                    </td>
                                    <td scope="col" class="col-2 text-center">
                                        <span class="badge text-bg-danger"></span>
                                        <span id="badge-supplier-<?= $b->kode_upah ?>" class="badge <?= $b->jumlah_supplier > 0 ? 'text-bg-info' : 'text-bg-danger' ?>">
                                            <i class="fa-solid fa-recycle fa-lg"></i>
                                            &nbsp;
                                            <?= $b->jumlah_supplier ?> Supplier
                                        </span>
                                    </td>

                                    <!-- status -->
                                    <td scope="col" class="col-2 text-center">
                                        <span id="status-<?= $b->id_upah ?>" class="badge <?= $b->status_upah == 'Active' ? 'text-bg-success' : 'text-bg-secondary' ?>">
                                            <i class="fa-solid <?= $b->status_upah == 'Active' ? 'fa-recycle' : 'fa-ban' ?> fa-lg"></i>
                                            <?= $b->status_upah ?>
                                        </span>
                                    </td>

                                    <td scope="col" class="col-2 text-center">
                                        <small>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <!-- Tombol Detail & Ubah -->
                                                <button type="button" class="btn btn-sm btn-warning btn-detail" data-bs-toggle="modal" data-id="<?= $b->id_upah ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop-detail-upah" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail & Ubah Data">
                                                    <i class="fa-solid fa-users-viewfinder fa-lg px-1"></i>
                                                </button>
                                                <!-- <small>Detail</small> -->
                                                <button type="button" class="btn btn-sm btn-primary btn-detail-upah" data-bs-toggle="modal" data-bs-target="#staticBackdrop-tambah-detail-upah-supplier" data-id="<?= $b->id_upah ?>" data-kode="<?= $b->kode_upah ?>" data-uraian="<?= $b->uraian_upah ?>">
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data Supplier Per-Item">
                                                        <i class="fa-solid fa-user-plus fa-lg px-1"></i>
                                                    </a>
                                                </button><!-- <small>Detail</small> -->
                                                <!-- <small>Hapus</small> -->

                                                <!-- Tombol Toggle Status Active / Non Active -->
                                                <button class="btn btn-sm btn-toggle-status <?= $b->status_upah == 'Active' ? 'btn-danger' : 'btn-success' ?>" data-id="<?= $b->id_upah ?>" data-status="<?= $b->status_upah ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $b->status_upah == 'Active' ? 'Non-Aktifkan' : 'Aktifkan' ?>">
                                                    <i class="fa-solid <?= $b->status_upah == 'Active' ? 'fa-ban' : 'fa-check' ?> fa-lg"></i>
                                                </button>
                                            </div>
                                        </small>
                                    </td>
                                </tr>
                            <?php endforeach; ?>