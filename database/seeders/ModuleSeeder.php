<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [
                'title' => 'Introduction to Camera Angles',
                'description' => "Welcome to the world of visual storytelling! This module introduces the concept of camera angles and why they matter. You'll learn how changing the position of your camera can dramatically alter the mood, meaning, and focus of your photo or video.\n\n**Key Points:**\n* A camera angle is simply the position of the camera in relation to the subject.\n* Angles help tell a story without using words.\n* Different angles can make a subject look powerful, weak, fast, or slow.\n* Mastering angles is the first step to shooting like a professional.",
                'image_path' => null,
            ],
            [
                'title' => 'Eye Level Angle',
                'description' => "The Eye Level Angle is the most natural and commonly used camera shot. By placing the camera directly at the subject's eye level, you create a neutral and relatable perspective that mimics how we see people in real life.\n\n**Key Points:**\n* Creates a sense of equality and connection between the subject and the viewer.\n* Perfect for interviews, portraits, and everyday conversations.\n* It does not distort the subject’s size or shape.\n* Best used when you want the audience to feel directly engaged with the subject.",
                'image_path' => 'assets/images/eye_level.png',
            ],
            [
                'title' => 'High Angle Shot',
                'description' => "A High Angle Shot is taken when the camera is positioned above the subject, looking down. This technique is often used to make the subject appear smaller, vulnerable, or less significant within their environment.\n\n**Key Points:**\n* Creates a feeling of weakness or submissiveness in the subject.\n* Great for showing a subject being overwhelmed by their surroundings.\n* Often used in movies to show a character who is in trouble or feeling lost.\n* The higher the angle, the stronger the psychological effect.",
                'image_path' => 'assets/images/high_angle.png',
            ],
            [
                'title' => 'Low Angle Shot',
                'description' => "A Low Angle Shot is taken with the camera placed below the subject, pointing upward. This angle flips the script on the High Angle, making the subject appear larger than life, powerful, and dominant.\n\n**Key Points:**\n* Makes the subject look heroic, intimidating, or authoritative.\n* Commonly used in superhero movies to emphasize a character's strength.\n* Can make buildings and landscapes feel massive and towering.\n* A great tool for making small subjects appear much larger.",
                'image_path' => 'assets/images/low_angle.png',
            ],
            [
                'title' => 'Bird’s Eye View',
                'description' => "Take your camera to the sky! The Bird’s Eye View is an extreme high angle shot that looks directly down on the subject from above. It provides a unique, map-like perspective of the scene and the subjects moving within it.\n\n**Key Points:**\n* Provides a complete overview of the scene and location.\n* Makes subjects look like tiny ants, emphasizing the scale of the environment.\n* Great for showing complex movements, like a crowd of people or a busy street.\n* Often captured using drones or by shooting from high buildings.",
                'image_path' => 'assets/images/bird_eye.png',
            ],
            [
                'title' => 'Frog’s Eye View',
                'description' => "Get low to the ground with the Frog’s Eye View! Also known as a worm's eye view, this is an extreme low angle shot taken from the floor level looking up, giving the viewer a perspective they rarely see in everyday life.\n\n**Key Points:**\n* Places the viewer right in the middle of the action on the ground.\n* Makes everyday objects look giant and mysterious.\n* Excellent for capturing footsteps, moving cars, or pets.\n* Adds a dramatic and dynamic feel to action sequences.",
                'image_path' => 'assets/images/frog_eye.png',
            ],
            [
                'title' => 'Over-the-Shoulder Shot',
                'description' => "The Over-the-Shoulder (OTS) shot is a standard technique used when two characters are having a conversation. The camera is placed behind one person, looking past their shoulder at the other person, helping the audience feel like they are part of the chat.\n\n**Key Points:**\n* Establishes the physical relationship and distance between two characters.\n* Keeps the audience engaged in the dialogue by showing reactions.\n* Creates a sense of depth by having a blurred shoulder in the foreground.\n* Essential for filming realistic conversations and interviews.",
                'image_path' => null,
            ],
            [
                'title' => 'Dutch Angle (Tilted Shot)',
                'description' => "Want to make your audience feel uneasy? The Dutch Angle is created by purposely tilting the camera to one side so the horizon line is no longer level. It’s a creative tool used to show that something in the scene is wrong, chaotic, or confusing.\n\n**Key Points:**\n* Creates a feeling of tension, madness, or disorientation.\n* Often used in horror, thriller, and action movies.\n* Best used sparingly—too many tilted shots can distract the viewer.\n* Helps visually represent a character's internal panic or confusion.",
                'image_path' => null,
            ],
            [
                'title' => 'Close-Up Shot',
                'description' => "The Close-Up Shot focuses tightly on a subject, usually showing just their face and shoulders. It is the best way to capture raw emotion, highlight important details, and force the viewer to focus on exactly what you want them to see.\n\n**Key Points:**\n* Creates intimacy and draws the audience into the character's feelings.\n* Eliminates distracting background elements.\n* Used to reveal subtle facial expressions like a tear or a smirk.\n* Can also be used on objects (like a ticking clock) to build suspense.",
                'image_path' => null,
            ],
            [
                'title' => 'Wide Shot (Long Shot)',
                'description' => "The Wide Shot captures the entire subject along with a large amount of their surroundings. It answers the question, \"Where are we?\" by establishing the setting and showing the subject's relationship to the world around them.\n\n**Key Points:**\n* Acts as an \"establishing shot\" to tell the viewer where the scene is happening.\n* Shows the subject's full body and how they interact with the environment.\n* Great for capturing beautiful landscapes, cityscapes, and large groups of people.\n* Provides breathing room before cutting to tighter, closer angles.",
                'image_path' => null,
            ]
        ];

        foreach ($modules as $module) {
            Module::create($module);
        }
    }
}
