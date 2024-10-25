<?php

class Report
{
  public function generatePdfReport()
  {
    // Generowanie nagłówka w formacie PDF
    echo "Generowanie nagłówka w formacie PDF\n";

    // Generowanie danych w formacie PDF
    echo "Generowanie danych w formacie PDF\n";

    // Generowanie stopki w formacie PDF
    echo "Generowanie stopki w formacie PDF\n";
  }

  public function generateCsvReport()
  {
    // Generowanie nagłówka w formacie CSV
    echo "Generowanie nagłówka w formacie CSV\n";

    // Generowanie danych w formacie CSV
    echo "Generowanie danych w formacie CSV\n";

    // Generowanie stopki w formacie CSV
    echo "Generowanie stopki w formacie CSV\n";
  }

  public function generateHtmlReport()
  {
    // Generowanie nagłówka w formacie HTML
    echo "Generowanie nagłówka w formacie HTML\n";

    // Generowanie danych w formacie HTML
    echo "Generowanie danych w formacie HTML\n";

    // Generowanie stopki w formacie HTML
    echo "Generowanie stopki w formacie HTML\n";
  }
}

// Przykład użycia

$report = new Report();
$report->generatePdfReport();

echo "\n";

$report->generateCsvReport();

echo "\n";

$report->generateHtmlReport();

/**
 * FIXME: Duplikacja:
 * Każda metoda generowania raportu zawiera powtarzający się kod, np. generowanie nagłówka, danych i stopki. W przypadku dodania lub zmiany pewnych funkcjonalności, konieczne jest wprowadzenie zmian we wszystkich metodach.
 *
 * FIXME: Utrzymanie:
 * Brak jednolitej struktury i wspólnej logiki sprawia, że kod jest trudniejszy do zrozumienia, utrzymania i rozbudowy. Zmiany w generowaniu raportów muszą być dokonywane w każdej z osobnych metod.
 *
 * FIXME: Brak elastyczności:
 * W przypadku dodania nowego formatu raportu, konieczne jest dodanie nowej metody w klasie Report. To prowadzi do rozrastania się klasy i utrudnia rozszerzanie systemu.
 */
