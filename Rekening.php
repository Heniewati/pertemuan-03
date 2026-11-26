
<?php

class Rekening
{
    public string $nomor;
    private string $pemilik;
    private float $saldo = 0.0;
    private array $riwayat = [];

    public function __construct(string $nomor, string $pemilik)
    {
        $this->nomor = $nomor;
        $this->pemilik = $pemilik;
    }

    public function getPemilik(): string
    {
        return $this->pemilik;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function getRiwayat(): array
    {
        return $this->riwayat;
    }

    public function setor(float $jumlah): bool
    {
        if ($jumlah <= 0) {
            return false;
        }

        $this->saldo += $jumlah;

        $this->riwayat[] = [
            'jenis' => 'Setor',
            'jumlah' => $jumlah
        ];

        return true;
    }

    public function tarik(float $jumlah): bool
    {
        if ($jumlah <= 0 || $jumlah > $this->saldo) {
            return false;
        }

        $this->saldo -= $jumlah;

        $this->riwayat[] = [
            'jenis' => 'Penarikan',
            'jumlah' => $jumlah
        ];

        return true;
    }

    public function transfer(
        Rekening $tujuan,
        float $jumlah
    ): bool {
        if (
            $jumlah <= 0 ||
            $jumlah > $this->saldo ||
            $tujuan === $this
        ) {
            return false;
        }

        $this->saldo -= $jumlah;
        $tujuan->saldo += $jumlah;

        $this->riwayat[] = [
            'jenis' => 'Transfer keluar',
            'tujuan' => $tujuan->nomor,
            'jumlah' => $jumlah
        ];

        $tujuan->riwayat[] = [
            'jenis' => 'Transfer masuk',
            'dari' => $this->nomor,
            'jumlah' => $jumlah
        ];

        return true;
    }
}
