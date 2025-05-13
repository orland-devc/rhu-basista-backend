<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObstetricSheetsTable extends Migration
{
    public function up(): void
    {
        Schema::create('obstetric_sheets', function (Blueprint $table) {
            $table->id();

            // Foreign key to patient table (if applicable)
            $table->foreignId('patient_admission_id')->constrained()->nullOnDelete();

            $table->string('reason_for_admission')->nullable();
            $table->string('admitting_impression')->nullable();
            $table->string('final_diagnosis')->nullable();
            $table->text('pertinent_medical_history')->nullable();
            $table->string('educational_attainment')->nullable();

            // Present Pregnancy
            $table->date('lmp')->nullable(); // Last Menstrual Period
            $table->date('edc')->nullable(); // Estimated Date of Confinement
            $table->integer('aog')->nullable(); // Age of Gestation in weeks
            $table->integer('weeks_pmp')->nullable();
            $table->boolean('morning_sickness')->nullable();
            $table->string('quickening')->nullable();
            $table->text('abnormal_signs')->nullable();
            $table->string('primary_antenatal_condition')->nullable();
            $table->integer('antenatal_visits_first')->nullable();
            $table->integer('antenatal_visits_last')->nullable();
            $table->string('contraceptive_methods')->nullable();
            $table->integer('additional_children_wanted')->nullable();

            // Illness history
            $table->text('history_of_present_illness')->nullable();

            // Physical Findings
            $table->string('general_condition')->nullable();
            $table->string('bp')->nullable();
            $table->integer('hr')->nullable();
            $table->integer('rr')->nullable();
            $table->decimal('temp', 4, 1)->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->decimal('fundic_height', 5, 2)->nullable();
            $table->string('presentation')->nullable();
            $table->boolean('engaged')->default(false);
            $table->boolean('floating')->default(false);
            $table->decimal('efw', 5, 2)->nullable(); // Estimated Fetal Weight
            $table->string('fht')->nullable(); // Fetal Heart Tones
            $table->string('extremities')->nullable();
            $table->string('edema')->nullable();
            $table->boolean('albuminuria')->nullable();
            $table->boolean('glucosuria')->nullable();
            $table->string('hemoglobin')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obstetric_sheets');
    }
}