@if($direcao == 'Para cima, para a esquerda')
    <i class="fa-solid fa-arrow-turn-up fa-rotate-270" style="color: #ffffff;"></i>
@elseif($direcao == 'Para a esquerda, para baixo')
    <i class="fa-solid fa-arrow-turn-up fa-rotate-180" style="color: #ffffff;"></i>
@elseif($direcao == 'Para baixo, para a direita')
    <i class="fa-solid fa-arrow-turn-up fa-rotate-90" style="color: #ffffff;"></i>
@elseif($direcao == 'Para a direita, para cima')
    <i class="fa-solid fa-arrow-turn-up" style="color: #ffffff;"></i>
@elseif($direcao == 'Para cima, para a direita')
    <i class="fa-solid fa-arrow-turn-down fa-rotate-270" style="color: #ffffff;"></i>
@elseif($direcao == 'Para a esquerda, para cima')
    <i class="fa-solid fa-arrow-turn-down fa-rotate-180" style="color: #ffffff;"></i>
@elseif($direcao == 'Para baixo, para a esquerda')
    <i class="fa-solid fa-arrow-turn-down fa-rotate-90" style="color: #ffffff;"></i>
@elseif($direcao == 'Para a direita, para baixo')
    <i class="fa-solid fa-arrow-turn-down" style="color: #ffffff;"></i>
@elseif($direcao == 'Para cima')
    <i class="fa-solid fa-arrow-up" style="color: #ffffff;"></i>
@elseif($direcao == 'Para baixo')
    <i class="fa-solid fa-arrow-down" style="color: #ffffff;"></i>
@elseif($direcao == 'Para a esquerda')
    <i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i>
@elseif($direcao == 'Para a direita')
    <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i>
@endif
