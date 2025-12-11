<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Major;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $majors = Major::all();

        if ($majors->isEmpty()) {
            return;
        }

        $doctors = [
            ['name' => 'د. أحمد محمد', 'email' => 'ahmed.mohamed@clinic.com', 'phone' => '01012345678', 'image' => 'https://randomuser.me/api/portraits/men/1.jpg', 'bio' => 'استشاري أمراض القلب مع خبرة تزيد عن 15 عاماً', 'major_id' => $majors->random()->id],
            ['name' => 'د. فاطمة علي', 'email' => 'fatma.ali@clinic.com', 'phone' => '01112345678', 'image' => 'https://randomuser.me/api/portraits/women/2.jpg', 'bio' => 'أخصائية الأمراض الجلدية والتجميل', 'major_id' => $majors->random()->id],
            ['name' => 'د. محمود حسن', 'email' => 'mahmoud.hassan@clinic.com', 'phone' => '01212345678', 'image' => 'https://randomuser.me/api/portraits/men/3.jpg', 'bio' => 'استشاري جراحة العظام والمفاصل', 'major_id' => $majors->random()->id],
            ['name' => 'د. سارة إبراهيم', 'email' => 'sara.ibrahim@clinic.com', 'phone' => '01512345678', 'image' => 'https://randomuser.me/api/portraits/women/4.jpg', 'bio' => 'استشارية طب الأطفال وحديثي الولادة', 'major_id' => $majors->random()->id],
            ['name' => 'د. خالد عبدالله', 'email' => 'khaled.abdullah@clinic.com', 'phone' => '01012345679', 'image' => 'https://randomuser.me/api/portraits/men/5.jpg', 'bio' => 'أخصائي طب وجراحة العيون', 'major_id' => $majors->random()->id],
            ['name' => 'د. منى سعيد', 'email' => 'mona.saeed@clinic.com', 'phone' => '01112345679', 'image' => 'https://randomuser.me/api/portraits/women/6.jpg', 'bio' => 'استشارية النساء والتوليد', 'major_id' => $majors->random()->id],
            ['name' => 'د. عمر يوسف', 'email' => 'omar.yousef@clinic.com', 'phone' => '01212345679', 'image' => 'https://randomuser.me/api/portraits/men/7.jpg', 'bio' => 'استشاري الأمراض الباطنة', 'major_id' => $majors->random()->id],
            ['name' => 'د. هدى أحمد', 'email' => 'huda.ahmed@clinic.com', 'phone' => '01512345679', 'image' => 'https://randomuser.me/api/portraits/women/8.jpg', 'bio' => 'أخصائية الطب النفسي والعلاج السلوكي', 'major_id' => $majors->random()->id],
            ['name' => 'د. حسام فتحي', 'email' => 'hossam.fathy@clinic.com', 'phone' => '01012345680', 'image' => 'https://randomuser.me/api/portraits/men/9.jpg', 'bio' => 'استشاري جراحة عامة', 'major_id' => $majors->random()->id],
            ['name' => 'د. نورا محمود', 'email' => 'nora.mahmoud@clinic.com', 'phone' => '01112345680', 'image' => 'https://randomuser.me/api/portraits/women/10.jpg', 'bio' => 'أخصائية أمراض الأعصاب', 'major_id' => $majors->random()->id],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
