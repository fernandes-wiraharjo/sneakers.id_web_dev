<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-detail-activity-{{ $item->id }}">
  Show
</button>

<div class="modal text-left fade" id="modal-detail-activity-{{ $item->id }}" tabindex="-1" aria-labelledby="modal-detail-activity-{{ $item->id }}Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="modal-detail-activity-{{ $item->id }}Label">Activity</h5>
         <!--begin::Close-->
         <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <span class="svg-icon svg-icon-2x"><i class="fas fa-times"></i></span>
        </div>
        <!--end::Close-->
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">New Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_3">Old Data</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                <div >
                    <table class="table" style="table-layout: fixed; text-align:left;">
                      <tbody>
                        <tr>
                            <td colspan="2">
                              <p class="card-title font-weight-bold my-2 text-center">User Account</p>
                            </td>
                          </tr>
                          <tr>
                            <td>Date</td>
                            <td>{{ $item->created_at->format('d/m/y H:i') }} - {{ $item->created_at->diffForHumans() }}</td>
                          </tr>
                          <tr>
                            <td>Name</td>
                            <td>{{ $item->user->name }}</td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td>{{ $item->user->email }}</td>
                          </tr>

                          <tr>
                            <td>Event Type</td>
                            <td>
                              <span class="badge badge-{{ $item->colors[$item->type] ?? 'warning' }}">
                                {{ ucwords($item->type) }}
                              </span>
                            </td>
                          </tr>

                          <tr>
                            <td>Model</td>
                            <td>{{ ucwords($item->logable_type) }}</td>
                          </tr>
                          <tr>
                            <td>User ID</td>
                            <td>{{ ucwords($item->logable_id) }}</td>
                          </tr>
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                <div>
                    <table class="table" style="table-layout: fixed; text-align:left;">
                      <tbody>
                        <tr>
                            <td colspan="2">
                              <p class="card-title font-weight-bold my-2 text-center">New Data</p>
                            </td>
                          </tr>

                          @foreach ((Array) $item->new_data as $field => $data)
                          @php
                              $new = is_array($data) ? json_encode($data) : $data;
                              $old = isset($item->old_data[$field]) ? is_array($item->old_data[$field]) ? json_encode($item->old_data[$field]) : $item->old_data[$field] : $new
                          @endphp
                              <tr>
                                <td>{{ $field }}</td>
                                <td class="{{ ($old === $new) ? '' : 'text-danger' }}">{!!  $new !!}</td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                <div>
                    <table class="table" style="table-layout: fixed; text-align:left;">
                      <tbody>
                        <tr>
                          <td colspan="2">
                            <p class="card-title font-weight-bold my-2 text-center">Old Data</p>
                          </td>
                        </tr>

                        @forelse ((Array) $item->old_data as $field => $data)
                          @php
                              $old = is_array($data) ? json_encode($data) : $data;
                              $new = isset($item->new_data[$field]) ? is_array($item->new_data[$field]) ? json_encode($item->new_data[$field]) : $item->new_data[$field] : $old
                          @endphp
                            <tr>
                              <td>{{ $field }}</td>
                              <td class="{{ ($old === $new) ? '' : 'text-warning' }}">{!!  $old !!}</td>
                            </tr>
                            @empty
                            <tr>
                              <td colspan="2">No data available</td>
                            </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
      </div>
  </div>
</div>
