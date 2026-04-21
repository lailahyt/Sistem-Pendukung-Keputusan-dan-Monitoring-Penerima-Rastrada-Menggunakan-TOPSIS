<!-- Modal -->
<div class="modal fade" id="confirmationReject{{ $item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/account-request/approval/{{ $item->id }}" method="POST">
      @csrf
      @method('POST')
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="confirmationRejectlLabel">Konfirmasi Non Aktif Akun</h5>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="for" value="deactivate">
            Apakah anda yakin untuk menon-aktifkan  akun ini?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-danger">Ya, Nonaktifkan</button>
        </div>
        </div>
    </form>
  </div>
</div>
