<mjml>
  <mj-body background-color="#f9f9f9">
    <mj-section background-color="#fff">
      <mj-column>
        <mj-image width="163px" src="https://kur.jogjaprov.go.id/front/img/logo_kur_jogja_new_revisi.png"></mj-image>
      </mj-column>
    </mj-section>

    <mj-section background-color="#b7192c" text-align="center">
      <mj-column>
        <mj-image width="58px" height="58px" src="{{ asset('images/icons/lock.png') }}"></mj-image>
        <mj-text align="center" font-size="28px" color="#ffffff" font-family="Lato">Pencadangan Basis Data Harian</mj-text>
      </mj-column>
    </mj-section>

    <mj-section background-color="#fff" padding="40px 40px 30px 40px">
      <mj-column>
        <mj-text font-size="18px" font-family='Lato' color="#666666" line-height="140%">
          Halo,
        </mj-text>
        <mj-text font-size="18px" font-family='Lato' color="#666666" line-height="140%">
          Kami mengirimkan ini surel ini sebagai kunci untuk membuka basis data yang sudah kami cadangkan. Anda bisa membukanya melalui <a style="color: #161a39;" href="{{ $downloadUrl }}" target="_blank">{{ $downloadUrl }}</a> atau dengan menekan tombol dibawah.
        </mj-text>
        <mj-text font-size="18px" font-family='Lato' color="#666666" line-height="140%">
          Alamat tersebut akan kadaluarsa dalam waktu <strong>30 hari</strong> setelah surel ini terkirim.
        </mj-text>
        <mj-text font-size="18px" font-family='Lato' color="#666666" line-height="140%">
          Untuk mengunduh basis data yang sudah dicadangkan, tekan tombol berikut:
        </mj-text>

        <mj-button color="#ffffff" background-color="#b7192c" width="100%" height="48px" font-size="18px" href="{{ $downloadUrl }}">
          Unduh
        </mj-button>
        <mj-text font-size="16px" color="#888888" font-style="italic" line-height="20px">
          Silahkan abaikan surel ini jika anda tidak ingin mencadangkan basis data anda.
        </mj-text>
      </mj-column>
    </mj-section>

    <mj-include path="./layout/footer.mjml" />
  </mj-body>
</mjml>