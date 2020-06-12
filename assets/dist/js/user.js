const origin = document.location.origin;
const siplaburl = document.location.pathname.split('/')[1];
const base_url = origin+"/"+siplaburl;

function isNumberKey(evt) {
  var charCode = (evt.which) ? evt.which: event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
  return true;
}

function filename() {
  var filename = $('#imageinput').val().split("\\");
  var image = filename.slice(-1)[0];
  $('#imagename').text(image);
}

function ubahLogo() {
  var toslice = $('#ubahlogo').val().split('\\')
  var newlogo = toslice.slice(-1)[0];

  $('#newlogoname').text(newlogo);

}

function ubahIcon() {
  var toslice = $('#ubahicon').val().split('\\')
  var newicon = toslice.slice(-1)[0];

  $('#newiconname').text(newicon);

}

function getnamaruangan(evt) {
  var toslice = $('#ubahgambaruangan').val().split('\\');
  var newgambarruangan = toslice.slice(-1)[0];

  $('#gambarruanganbaru').text(newgambarruangan);
}

function cekkoderuangan(event) {
  var kode_ruangan = $('#kode_ruangan').val();
  var id_ruangan = $('#id_ruangan').val();

  $.ajax({
    url: base_url + '/ajax/ajaxcekkoderuangan',
    type: 'POST',
    data: {
      'kode_ruangan': kode_ruangan, 'id_ruangan': id_ruangan
    },
    success: function (data) {
      if (data != "") {
        $('#alertkoderuangan').text(data);
        $('#btnubahruangan').attr('disabled', true);
      } else {
        $('#btnubahruangan').removeAttr('disabled');
      }
    }
  })
}

function ceknip() {
  var nip = $('#nip').val();

  $.ajax({
    url: base_url + '/ajax/ceknip',
    type: 'POST',
    data: 'nip=' + nip,
    success: function (data) {
      if (data != "") {
        $('#alertdaftar').text(data);
        $('#alertdaftar').removeAttr('style');
        $('#daftar').attr('disabled', true);
      } else {
        $('#alertdaftar').text(data);
        $('#alertdaftar').attr('style', 'display: none');
        $('#daftar').removeAttr('disabled');
      }
    }
  })
}

$(document).ready(function () {
  // PUBLIK
  // CARI HELP
  $('#carihelp').keyup(function () {
    var keyword = $('#carihelp').val();

    $.ajax({
      url: base_url + '/ajax/carihelp',
      type: 'POST',
      data: 'keyword=' + keyword,
      success: function (data) {
        $('.tabelhelppublik').html(data);
      }
    })
  })



  // ADMIN HELP
  $('#carihelpadmin').keyup(function () {
    var keyword = $('#carihelpadmin').val();

    $.ajax({
      url: base_url + '/ajax/carihelpadmin',
      type: 'POST',
      data: 'keyword=' + keyword,
      success: function (data) {
        $('#tabelhelpadmin').html(data);
      }
    })
  })

  // edit help
  $('#edithelp').on('show.bs.modal', function (e) {
    var id_help = $(e.relatedTarget).data('id_help');
    var judul_help = $(e.relatedTarget).data('judul_help');
    var isi_help = $(e.relatedTarget).data('isi_help');

    $('#id_help').val(id_help);
    $('#judul_help').val(judul_help);
    $('#isi_help').val(isi_help);
  })

  $('#jawabask').on('show.bs.modal', function (e) {
    var id_ask = $(e.relatedTarget).data('id_ask');
    var judul_ask = $(e.relatedTarget).data('judul_ask');
    var isi_ask = $(e.relatedTarget).data('isi_ask');

    $('#id_ask').val(id_ask);
    $('#judul_ask').val(judul_ask);
    $('#isi_ask').val(isi_ask);
  })

  // editprofil
  $('#editprofiladmin').on('show.bs.modal', function (e) {
    var id_user = $(e.relatedTarget).data('id_user');

    var ajaxeditprofil = document.getElementById('ajaxeditprofil');

    $.ajax({
      url: base_url + '/ajax/editprofil',
      type: 'POST',
      data: 'id_user=' + id_user,
      success: function (data) {
        ajaxeditprofil.innerHTML = data;
      }
    })
  })

  // validasi password
  $('#password_baru2').keyup(function () {
    var password_lama = $('#password_lama').val();
    var password_baru = $('#password_baru').val();
    var password_baru2 = $('#password_baru2').val();

    if ($('#password_baru').val() != $('#password_baru2').val()) {
      $('#password_baru_message').text('Password dan konfirmasi tidak sesuai');
      $('#btnubahpassword').attr('disabled', true);
    } else {
      $('#password_baru_message').text('');
      $('#btnubahpassword').removeAttr('disabled');
    }
  })

  // ubah situs
  $('#ubahsitus').on('show.bs.modal',
    function (event) {
      var id_site = $(event.relatedTarget).data('id_site');

      $.ajax({
        url: base_url + '/ajax/ubahsitus',
        method: 'POST',
        data: {
          'id_site': id_site
        },
        success: function (data) {
          $('#ajaxubahsitus').html(data);
        }
      })
    })

  $('#ubahruangan').on('show.bs.modal',
    function (event) {
      var id_ruangan = $(event.relatedTarget).data('id_ruangan');

      $.ajax({
        url: base_url + '/ajax/ubahruangan',
        method: 'POST',
        data: {
          'id_ruangan': id_ruangan
        },
        success: function (data) {
          $('#ajaxubahruangan').html(data);
        }
      })
    })



  // LIVE LOAD KOTAK PERTANYAAN
  $.ajax({
    url: base_url + '/ajax/livekotakpertanyaan',
    dataType: 'html',
    success: function (data) {
      $('#livekotakpertanyaan').html(data);
    }
  })

  // AUTH
  // MENDAFTAR
  $('#mendaftar').on('show.bs.modal',
    function (e) {
      // verify username
      $('.usernamedaftar').keyup(function () {
        var username = $('.usernamedaftar').val();

        $.ajax({
          url: base_url + '/ajax/cekusernamedaftar/' + username,
          type: 'POST',
          success: function (data) {
            if (data != "") {
              $('#alertdaftar').text(data);
              $('#alertdaftar').removeAttr('style');
              $('#daftar').attr('disabled', true);
            } else {
              $('#alertdaftar').text(data);
              $('#alertdaftar').attr('style', 'display: none');
              $('#daftar').removeAttr('disabled');
            }
          }
        })
        .done(function () {
          console.log("success");
        })
        .fail(function () {
          console.log("error");
        })
        .always(function () {
          console.log("complete");
        });
      });

      // verify password
      $('#password2').keyup(function () {
        var password = $('#password').val();
        var password2 = $('#password2').val();

        if (password != password2) {
          $('#alertdaftar').text('Password dan konfirmasi tidak sama!');
          $('#alertdaftar').removeAttr('style');
          $('#daftar').attr('disabled', true);
        } else {
          $('#alertdaftar').attr('style', 'display: none');
          $('#alertdaftar').text('');
          $('#daftar').removeAttr('disabled');
        }
      });
    })

  // PEMINJAM
  // MEMINJAM
  $('#pinjam').on('show.bs.modal', function (e) {
    var id_ruangan = $(e.relatedTarget).data('id_ruangan');

    $('#id_ruangan').val(id_ruangan);
  })

  // verify req date
  $('.verifydate').change(function (e) {
    e.preventDefault();
    var tanggal = $('#tanggal').val();
    var jam_mulai = $('#pinjam_jam_mulai').val();
    var jam_selesai = $('#pinjam_jam_selesai').val();

    $.ajax({
      url: base_url + '/ajax/ajaxverifyreqdate',
      type: 'POST',
      data: {
        'tanggal': tanggal,
        'jam_mulai': jam_mulai,
        'jam_selesai': jam_selesai
      },
      success: function (data) {
        $('#alerttanggal').html(data);
        if (data != "") {
          $('.pinjam').attr('disabled', true);
        } else {
          $('.pinjam').removeAttr('disabled');
        }
      }
    })
  });

  // ADMIN
  // DATA TABEL
  $('#tabel').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
  });

  $('#tabel2').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
  });

  // filterbulan
  $('#filter-bulan').change(function () {
    var bulan = $('#filter-bulan option:selected').val();

    $.ajax({
      url: base_url + '/ajax/filter_bulan',
      type: 'POST',
      dataType: 'html',
      data: {
        'bulan': bulan
      },
      success: function (data) {
        $('#tabeljadwal').html(data);
      }
    })
  })

  // filter-tanggal
  $('#filter_tanggal').change(function () {
    var tanggal = $('#filter_tanggal').val();

    $.ajax({
      url: '/ajax/filter_tanggal',
      type: 'POST',
      data: {
        'tanggal': tanggal
      },
      success: function (data) {
        $('#tabeljadwal').html(data);
      }
    })
  })

  // filter range tanggal
  $('#filter_tanggal2').change(function () {
    var tanggal1 = $('#filter_tanggal1').val();
    var tanggal2 = $('#filter_tanggal2').val();

    $.ajax({
      url: base_url + '/ajax/filter_range_tanggal',
      type: 'POST',
      dataType: 'html',
      data: {
        'tanggal1': tanggal1,
        'tanggal2': tanggal2
      },
      success: function (data) {
        $('#tabeljadwal').html(data);
      }
    })
  })

  // cetakjadwal
  $('#cetaklapjadwal').click(function () {
    $('#tabel').print();
  })

  // SITE SETTINGS
  // UBAH LOGO
  $('#logo').change(function () {
    var logo = $('#logo').val().split("\\");
    var logoname = logo.slice(-1)[0];
    $('#logoname').text('Ubah ke: ' + logoname);
  });

  // UBAH ICON
  $('#icon').change(function () {
    var icon = $('#icon').val().split("\\");
    var iconname = icon.slice(-1)[0];
    $('#iconname').text('Ubah ke: ' + iconname);
  });
})