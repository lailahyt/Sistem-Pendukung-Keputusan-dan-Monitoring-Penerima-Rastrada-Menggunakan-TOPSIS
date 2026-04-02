<!-- Modal -->
<div class="modal fade" id="confirmationDelete{{ $item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/resident/{{ $item->id }}" method="POST">
      @csrf
      @method('DELETE')
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="confirmationDeletelLabel">Konfirmasi Hapus</h5>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            Apakah anda yakin untuk menghapus ini?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
        </div>
        </div>
    </form>
  </div>
</div>
