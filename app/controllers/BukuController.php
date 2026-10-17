<?php
class BukuController
{
    public function __construct(private Buku $model) {}

    public function index(): void
    {
        $buku = $this->model->getAll();
        require __DIR__ . '/../views/buku/index.php';
    }

    public function create(): void
    {
        require __DIR__ . '/../views/buku/create.php';
    }

    public function store(): void
    {
        [$data, $errors] = $this->validateInput($_POST);

        if ($errors) {
            $this->flash('error', implode(' ', $errors));
            $this->redirect('create');
        }

        try {
            $this->model->insert($data);
            $this->flash('success', 'Data buku berhasil ditambahkan.');
            $this->redirect('index');
        } catch (PDOException $e) {
            $msg = $e->getCode() === '23000' ? 'ISBN sudah terdaftar.' : 'Gagal menyimpan data buku.';
            $this->flash('error', $msg);
            $this->redirect('create');
        }
    }

    public function edit(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $buku = $this->model->findById($id);

        if (!$buku) {
            http_response_code(404);
            exit('Data buku tidak ditemukan.');
        }

        require __DIR__ . '/../views/buku/edit.php';
    }

    public function update(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        [$data, $errors] = $this->validateInput($_POST);

        if ($errors) {
            $this->flash('error', implode(' ', $errors));
            $this->redirect('edit', '&id=' . $id);
        }

        try {
            $this->model->update($id, $data);
            $this->flash('success', 'Data buku berhasil diperbarui.');
            $this->redirect('index');
        } catch (PDOException $e) {
            $msg = $e->getCode() === '23000' ? 'ISBN sudah digunakan buku lain.' : 'Gagal memperbarui data buku.';
            $this->flash('error', $msg);
            $this->redirect('edit', '&id=' . $id);
        }
    }

    public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);

        try {
            $this->model->delete($id);
            $this->flash('success', 'Data buku berhasil dihapus.');
        } catch (PDOException $e) {
            $this->flash('error', 'Gagal menghapus data buku.');
        }

        $this->redirect('index');
    }

    private function validateInput(array $input): array
    {
        $data = [
            'isbn' => trim($input['isbn'] ?? ''),
            'judul' => trim($input['judul'] ?? ''),
            'penulis' => trim($input['penulis'] ?? ''),
            'penerbit' => trim($input['penerbit'] ?? ''),
            'tahun_terbit' => trim($input['tahun_terbit'] ?? ''),
            'stok' => trim($input['stok'] ?? '')
        ];

        $errors = [];
        foreach ($data as $field => $value) {
            if ($value === '') {
                $errors[] = 'Field ' . $field . ' wajib diisi.';
            }
        }
        if ($data['tahun_terbit'] !== '' && !preg_match('/^\d{4}$/', $data['tahun_terbit'])) {
            $errors[] = 'Tahun terbit harus 4 digit angka.';
        }
        if ($data['stok'] !== '' && !ctype_digit($data['stok'])) {
            $errors[] = 'Stok harus berupa angka bulat >= 0.';
        }

        return [$data, $errors];
    }

    private function flash(string $type, string $message): void
    {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }

    private function redirect(string $action = 'index', string $extra = ''): void
    {
        $url = 'index.php?page=buku';
        if ($action !== 'index') {
            $url .= '&action=' . $action;
        }
        header('Location: ' . $url . $extra);
        exit;
    }
}
?>