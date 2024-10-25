<?php

namespace NoChainOfResponsibility;

class Support
{
  public function handle(string $request): void
  {
    if ($request === "software") {
      echo "Helpdesk: Obsługuje zgłoszenie dotyczące oprogramowania.\n";
    } elseif ($request === "network") {
      echo "SystemAdmin: Obsługuje zgłoszenie dotyczące sieci.\n";
    } elseif ($request === "system_bug") {
      echo "Developer: Obsługuje zgłoszenie dotyczące błędu systemu.\n";
    } else {
      echo "Nikt nie obsłużył zgłoszenia.\n";
    }
  }
}

function clientCode(Support $support)
{
  foreach (['software', 'network', 'system_bug'] as $type) {
    echo "\n";
    echo "Klient: Kto obsługuje zgłoszenie dotyczące $type?\n";
    $support->handle($type);
  }
}

$support = new Support();

clientCode($support);


/**
 * FIXME: Single Responsibility Principle:
 * Klasa Support jest odpowiedzialna za obsługę wszystkich typów zgłoszeń. Jeśli chcielibyśmy dodać nowe typy zgłoszeń lub zmienić sposób obsługi istniejących, musielibyśmy zmodyfikować klasę Support. W przeciwnym razie, używając wzorca Chain of Responsibility, moglibyśmy łatwo dodać nowy handler lub zmienić istniejący bez modyfikacji innych klas.
 *
 * FIXME: Brak elastyczności:
 * W tym przypadku, jeśli chcielibyśmy zmienić kolejność obsługi zgłoszeń, musielibyśmy zmienić implementację metody handle. Przy użyciu Chain of Responsibility, moglibyśmy łatwo zmienić kolejność handlerów, zmieniając tylko klienta.
 *
 * FIXME: Brak hermetyzacji:
 * W tym podejściu, decyzja o tym, który obszar jest obsługiwany przez kogo, jest podejmowana w jednym miejscu, co jest naruszeniem hermetyzacji. W przypadku CoR, każdy handler sam decyduje, jakie zgłoszenia obsługuje.
 *
 * FIXME: Problem z rozszerzalnością:
 * Jeśli chcielibyśmy dodać nowy typ zgłoszenia lub nowy poziom wsparcia, musielibyśmy zmodyfikować klasę Support. Przy użyciu CoR, moglibyśmy łatwo dodać nowy handler bez modyfikacji istniejących klas.
 */
