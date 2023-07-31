<!-- Modal Date-->
<div class="modal fade" id="dateModalMemberTransactionHistory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card" style="padding: 20px;">
                <form class="" action="{{ route('admin.member.transaction-history.filter-date', ['id' => $member->id]) }}" method="GET">
                    <input id="startDate" class="form-control" name="created_at" type="date" />
                    <button type="submit" class="btn mt-4 btn-primary " style="background-color: #4F7AF6;">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end Modal Date -->