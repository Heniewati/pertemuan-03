
<?php

class Siswa
{
    private string $nama = '';
    private int $nilai = 0;

    public function setNama(string $nama): bool
    {
        if (trim($nama) === '') {
            return false;
        }

        $this->nama = trim($nama);

        return true;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function setNilai(int $nilai): bool
    {
        if ($nilai < 0 || $nilai > 100) {
            return false;
        }

        $this->nilai = $nilai;

        return true;
    }

    public function getNilai(): int
    {
        return $this->nilai;
    }
}
