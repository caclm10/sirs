axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const currentURL = new URL(window.location.href)
const idKelas = $(`input[name='id-kelas']`).val()
const jumlahSiswa = $("#jumlah-siswa")

const showToast = (status, text) => {
    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        showCloseButton: true,
        icon: status,
        title: text
    })
}

// Hapus siswa dari kelas
const hapusSiswaKelas = () => {
    $(`#siswa-kelas button[name="hapus"]`).on('click', function () {
        if (!confirm('Hapus siswa ini dari kelas ini?')) return false

        const parent = $(this).parent()

        parent.html(`<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>`)

        $.ajax({
            method: 'PATCH',
            url: `/dashboard/admin/kelas/${idKelas}`,
            data: {
                nis: $(this).data('nis'),
                'hapus-siswa': true
            },
            success: function (data) {
                parent.parent().remove()
                jumlahSiswa.text(`${+jumlahSiswa.text() - 1}`)
                showToast('success', data.message)

                let i = 1;
                $(`#siswa-kelas th[name="number"]`).each(function () {
                    this.innerText = i;
                    i++;
                })
            }
        })
    })
}

// Pencarian data untuk penambahan ke kelas
const searchData = target => {
    $(`form#search-${target}-form`).on('submit', function (event) {
        event.preventDefault()

        const search = $(this).find($("input")).val()
        const container = $(`#searched-${target}-container`)

        if (!search) {
            container.html(`<div class="text-center text-muted">Pencarian kosong</div>`)
            return false;
        }

        container.html(`<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>`)

        $.get(`/dashboard/admin/${target}?search=${search}&${target === 'siswa' ? 'tambah-kelas=1' : 'ganti-wali=1'}&id-kelas=${idKelas}`, function (data) {
            container.html(data)

            $(`#searched-${target} button[name=${target === 'siswa' ? '"tambah"' : '"pilih"'}]`).on('click', function (event) {
                const current = $(this)
                const parent = current.parent()
                const id = target === 'siswa' ? current.data('nis') : current.data('nip')

                parent.html(`<div class="spinner-border spinner-border-sm me-4" role="status"><span class="visually-hidden">Loading...</span></div>`)
                let data = {}

                if (target === 'siswa') data = { nis: id, 'tambah-siswa': true }
                else data = { nip: id, 'ganti-wali': true }

                $.ajax({
                    method: 'PATCH',
                    url: `/dashboard/admin/kelas/${idKelas}`,
                    data,
                    success: function (data) {
                        if (target === 'siswa') {
                            parent.html(`<span class="badge rounded-pill bg-success">Sudah ditambah</span>`)

                            $.get(`/dashboard/admin/kelas/${idKelas}`, function (data) {
                                $("#table-container").html(data)
                                jumlahSiswa.text(`${+jumlahSiswa.text() + 1}`)
                                hapusSiswaKelas()
                            })
                        } else {
                            parent.html(`<span class="badge rounded-pill bg-success">Terpilih</span>`)
                            $("#nama-wali").text(data.wali.nama)
                            showToast('success', data.message)
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            parent.html('')
                            parent.append(current)
                            showToast('error', xhr.responseJSON.message)
                        }
                    }
                })
            })
        })
    })
}

const gantiPeminatan = () => {
    const peminatanSelect = $(`select#peminatan`)
    const kelompokSelect = $("select#kelompok")

    if (kelompokSelect.length > 0) {
        if (kelompokSelect.val() === 'c') {
            peminatanSelect.html(`<option value="mipa">MIPA</option> <option value="ips">IPS</option>`)
            peminatanSelect.removeAttr('disabled')
        } else {
            peminatanSelect.html(`<option value="umum">Umum</option>`)
            peminatanSelect.attr('disabled', '1')
        }
    }
}

// Tampilkan toast jika ada input dengan id success-toast
const successToast = document.querySelector('#success-toast')
if (successToast) {
    showToast('success', successToast.value)
}

// Sidebar
$('.sidebar-toggler').on('click', function () {
    $('.navbar').toggleClass('expand')
    $('.main-container').toggleClass('expand')
    $('.sidebar').toggleClass('hide')
})
$(".mobile-sidebar-toggler").on('click', function () {
    $(".sidebar-mobile").toggleClass('hide')
    $(".sidebar-overlay").toggleClass('d-none')
    $("body").toggleClass('overflow-hidden')
})

// Ganti semester
$("select#semester").on('change', function () {
    window.location.href = this.options[this.selectedIndex].dataset.link
})

// Masking nilai input untuk nilai
const nilaiElements = document.querySelectorAll('.nilai')
for (const element of nilaiElements) {
    IMask(element,
        {
            mask: Number,
            min: 0,
            max: 100,
            thousandsSeparator: 'none',
            scale: 0
        }
    );
}

// Pencarian data
$("#search-form").on('submit', function (event) {
    event.preventDefault()
    const search = $(this).find($(`[name="search"]`)).val();
    const link = $(this).find($(`[name="link"]`)).val()

    $.get(`${link}?search=${search}`, function (data) {
        currentURL.searchParams.set('search', search)
        window.history.replaceState({}, '', currentURL.toString())
        $("#table-container").html(data)
    })
})

searchData('siswa')
searchData('wali-kelas')
hapusSiswaKelas()

if (document.querySelector('input[name="error-tambah-kelas"')) $('#tambahKelasModal').modal('show')

gantiPeminatan()
$("select#kelompok").on('change', gantiPeminatan)


$("#tanggal").on("change", function () {
    const url = window.location.href.split('?')[0]

    const searchParams = new URLSearchParams(window.location.search)
    searchParams.set('tanggal', $(this).val())

    window.location.href = url + '?' + searchParams.toString()
})

$("#presensi-actions button").on('click', function () {
    $("#keterangan").val($(this).data('value'))

    $("#update-presensi-form").trigger("submit")
})
