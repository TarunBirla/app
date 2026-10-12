<?php

namespace Tests\Feature;

use Tests\TestCase;

class SdpcPagesTest extends TestCase
{
    public function test_home_screen_loads_with_doctor_details(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Move Free.');
        $response->assertSee('Dr. Mahesh Sahu');
        $response->assertSee('098933 62477');
        $response->assertSee('211 Google reviews');
    }

    public function test_videos_library_screen_loads(): void
    {
        $response = $this->get('/videos');
        $response->assertStatus(200);
        $response->assertSee('Guided Physiotherapy Videos');
        $response->assertSee('Lower Back Pain Relief');
    }

    public function test_valid_video_slug_loads_details_page(): void
    {
        $response = $this->get('/videos/lower-back-pain-relief-core-stretches');
        $response->assertStatus(200);
        $response->assertSee('Lower Back Pain Relief');
        $response->assertSee('Safety Instructions');
    }

    public function test_invalid_video_slug_returns_404_page(): void
    {
        $response = $this->get('/videos/non-existent-video-slug');
        $response->assertStatus(404);
        $response->assertSee('404');
    }

    public function test_categories_screen_displays_all_19_categories(): void
    {
        $response = $this->get('/categories');
        $response->assertStatus(200);
        $response->assertSee('Acupuncture');
        $response->assertSee('Vestibular Rehabilitation');
        $response->assertSee('Post-Surgical Rehabilitation');
    }

    public function test_doctor_profile_and_contact_screens_load(): void
    {
        $this->get('/doctor')->assertStatus(200)->assertSee('Dr. Mahesh Sahu');
        $this->get('/contact')->assertStatus(200)->assertSee('Khatiwala Tank');
        $this->get('/offline')->assertStatus(200)->assertSee('Offline');
    }
}
