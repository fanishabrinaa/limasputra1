import { Passkeys } from '@laravel/passkeys';

// Menyediakan fitur passkey untuk digunakan oleh bagian halaman lainnya.
window.Passkeys = Passkeys;
window.dispatchEvent(new CustomEvent('passkeys:ready'));
