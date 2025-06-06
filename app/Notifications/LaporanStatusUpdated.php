<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LaporanStatusUpdated extends Notification
{
    use Queueable;

    protected $laporan;

    public function __construct($laporan)
    {
        $this->laporan = $laporan;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Status Laporan Kesalahan Anda Diperbarui')
            ->line('Laporan kesalahan untuk kata "' . $this->laporan->kata->kata_daerah . '" telah diperbarui.')
            ->line('Status: ' . ucfirst($this->laporan->status))
            ->line('Catatan Ahli: ' . ($this->laporan->catatan_ahli ?? 'Tidak ada catatan.'))
            ->action('Lihat Detail', url('/kata/' . $this->laporan->kata_id))
            ->line('Terima kasih telah melaporkan!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'laporan_id' => $this->laporan->id,
            'kata' => $this->laporan->kata->kata_daerah,
            'status' => $this->laporan->status,
            'catatan_ahli' => $this->laporan->catatan_ahli,
        ];
    }
}