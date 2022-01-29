      <table id="kt_datatable_example_1" class="table table-row-bordered gy-5" data-options='{!! json_encode($options) !!}'>
        <thead>
          <tr>
            @foreach ($fields as $field)
              <th>{{ $field }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody></tbody>
      </table>

      @push('scripts')
      <script>
          $("#kt_datatable_example_1").DataTable();
      </script>
      @endpush
