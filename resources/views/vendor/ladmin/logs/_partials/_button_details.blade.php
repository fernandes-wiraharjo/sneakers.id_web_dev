<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-log-{{ $i }}">
  Show
</button>

<div class="modal fade text-left" id="modal-log-{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="modal-log-{{ $i }}Label" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="modal-log-{{ $i }}Label">{{ $log['type'] }}</h5>
         <!--begin::Close-->
         <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <span class="svg-icon svg-icon-2x"><i class="fas fa-times"></i></span>
        </div>
        <!--end::Close-->
      </div>
      <div class="table-responsive">
        <table class="table">
          <tbody>
            <tr>
              <td>Date</td>
              <td>
                {{ Carbon\Carbon::parse($log['timestamp'])->format('d/m/y H:i') }} -
                {{ Carbon\Carbon::parse($log['timestamp'])->diffForHumans() }}
              </td>
            </tr>
            <tr>
              <td>ENV</td>
              <td>{{ $log['env'] }}</td>
            </tr>
            <tr>
              <td>Type</td>
              <td>
                <span class="badge badge-{{ $log['color'] ?? 'warning' }}">{{ $log['type'] }}</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-body bg-dark text-light">
        {{ $log['message'] }}
        </div>
      </div>
    </div>
  </div>
</div>
