<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Tambah Tugas!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addItemForm" action="{{ route('AddTask') }}" method="POST">
                @csrf
                    <div class="mb-3 d-flex align-items-center">
                        <label for="name" class="form-label me-3">Nama Teknisi</label>
                        <select class="form-select flex-grow-1" id="name" name="name" required>
                            <option value="">Pilih Teknisi</option>
                            @foreach($teknisi as $tech)
                                <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 d-flex align-items-center">
                        <label for="category" class="form-label me-3">Kategori</label>
                        <select class="form-select flex-grow-1" id="category" name="category" required>
                            <option value="">Pilih Kategori</option>
                            <option value="FO Cut">FO Cut</option>
                            <option value="Ping Intermitern">Ping Intermitern</option>
                            <option value="Speed tidak sesuai Kontrak">Speed tidak sesuai Kontrak</option>
                            <option value="Gangguan Routing">Gangguan Routing</option>
                            <option value="Gangguan Perangkat">Gangguan Perangkat</option>
                            <option value="Gangguan Radio">Gangguan Radio</option>
                            <option value="Pekerjaan External">Pekerjaan External</option>
                            <option value="Aktivasi FTTH">Aktivasi FTTH</option>
                            <option value="Maintenance">Maintenance</option>
                        </select>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="content" class="form-label me-3">Isi Aduan</label>
                        <textarea class="form-control flex-grow-1" id="content" name="content" rows="3" required></textarea>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="due" class="form-label me-3">Tenggat Waktu</label>
                        <input type="date" class="form-control flex-grow-1" id="due" name="due" required>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="color" class="form-label me-3">Status</label>
                        <select class="form-select flex-grow-1" id="color" name="color" required>
                            <option value="">Pilih Status</option>
                            <option value="merah">Isi Aduan Mendesak</option>
                            <option value="kuning">Isi Aduan tidak terlalu Mendesak</option>
                            <option value="hijau">Isi Aduan Aman, tidak Mendesak</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
