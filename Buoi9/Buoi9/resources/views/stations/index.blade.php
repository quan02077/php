@extends('layouts.app')

@section('content')

<h3>Trạm xe</h3>

<div class="text-center my-4">
    <select class="form-select w-50 mx-auto" id="wardSelect">
        <option value="">Tất cả phường</option>
        @foreach($wards as $ward)
            <option value="{{ $ward['name'] }}">{{ $ward['name'] }}</option>
        @endforeach
    </select>
</div>

<div id="stationList" class="mt-4">
    <div class="accordion" id="stationAccordion">
        @foreach($stations as $station)
        @php
            $available = $station->bicycles_count;
            $empty = $station->total_docks - $station->bicycles_count;
            $isActive = $station->status == 'active';
            $statusColor = $isActive ? 'text-success fw-bold' : 'text-danger fw-bold';
            $bikeColor = $available >= ($station->total_docks / 2)
                ? 'text-success fw-bold' : 'text-danger fw-bold';
            $emptyColor = $empty >= ($station->total_docks / 2)
                ? 'text-success fw-bold' : 'text-danger fw-bold';
        @endphp
        <div class="accordion-item station-item"
             data-ward="{{ $station->ward }}">

            <h2 class="accordion-header">
                <button class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $station->id }}">
                    <span class="{{ $isActive ? 'text-success' : 'text-warning' }}">
                        {{ $station->station_name }}
                    </span>
                    &nbsp;
                    (
                        <span class="{{ $bikeColor }}">
                            Số xe : {{ $available }}
                        </span>
                        &nbsp; - &nbsp;
                        <span class="{{ $emptyColor }}">
                            Số chỗ trống : {{ $empty }}
                        </span>
                    )
                </button>
            </h2>

            <div id="collapse{{ $station->id }}"
                 class="accordion-collapse collapse"
                 data-bs-parent="#stationAccordion">

                <div class="accordion-body text-start">
                    <p>
                        <strong>Địa chỉ:</strong> {{ $station->address }}
                    </p>

                    <p>
                        <strong>Tổng số chỗ:</strong>
                        <span class="fw-bold">{{ $station->total_docks }}</span>
                    </p>

                    <p>
                        <strong>Số chỗ trống:</strong>
                        <span class="{{ $empty >= ($station->total_docks / 2) ? 'text-success fw-bold' : 'text-danger fw-bold' }}">
                            {{ $empty }}
                        </span>
                    </p>

                    <p>
                        <strong>Số xe hiện có:</strong>
                        <span class="{{ $available >= ($station->total_docks / 2) ? 'text-success fw-bold' : 'text-danger fw-bold' }}">
                            {{ $available }}
                        </span>
                    </p>

                    <p>
                        <strong>Trạng thái:</strong>
                        <span class="{{ $isActive ? 'text-success fw-bold' : 'text-danger fw-bold' }}">
                            {{ $isActive ? 'Đang hoạt động' : 'Đang bảo trì' }}
                        </span>
                    </p>

                    <hr>

                    <!-- COMMENT -->
                    <!-- Tạm thời chưa viết, tí bổ sung sau -->
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>

<p id="emptyMsg" class="text-center text-muted d-none">
    Không có trạm
</p>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('wardSelect');
    const stations = document.querySelectorAll('.station-item');
    const emptyMsg = document.getElementById('emptyMsg');

    select.addEventListener('change', function () {
        const ward = this.value;
        let visible = 0;

        stations.forEach(item => {
            if (!ward || item.dataset.ward === ward) {
                item.style.display = '';
                visible++;
            } else {
                item.style.display = 'none';
            }
        });

        emptyMsg.classList.toggle('d-none', visible !== 0);
    });
});
</script>

@endsection

