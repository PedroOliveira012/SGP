@if($direcao == 'Para cima, para a esquerda')
    <i class="fa-solid fa-arrow-turn-down fa-xl" style="color: #ffffff;"></i>
@elseif($direcao == 'Para a esquerda, para baixo')
    <i class="fa-solid fa-arrow-turn-down fa-rotate-270 fa-xl" style="color: #ffffff;"></i>
@elseif($direcao == 'Para baixo, para a direita')
    <i class="fa-solid fa-arrow-turn-down fa-rotate-180 fa-xl" style="color: #ffffff;"></i>
@elseif($direcao == 'Para a direita, para cima')
    <i class="fa-solid fa-arrow-turn-down fa-rotate-90 fa-xl" style="color: #ffffff;"></i>
@elseif($direcao == 'Para cima, para a direita')
    <i class="fa-solid fa-arrow-turn-up fa-rotate-180 fa-xl" style="color: #ffffff;"></i>
@elseif($direcao == 'Para a esquerda, para cima')
    <i class="fa-solid fa-arrow-turn-up fa-rotate-90 fa-xl" style="color: #ffffff;"></i>
@elseif($direcao == 'Para baixo, para a esquerda')
    <i class="fa-solid fa-arrow-turn-up fa-xl" style="color: #ffffff;"></i>
@elseif($direcao == 'Para a direita, para baixo')
    <i class="fa-solid fa-arrow-turn-up fa-rotate-270 fa-xl" style="color: #ffffff;"></i>
@elseif($direcao == 'Para cima')
    <i class="fa-solid fa-arrow-up fa-xl" style="color: #ffffff;"></i>
@elseif($direcao == 'Para baixo')
    <i class="fa-solid fa-arrow-down fa-xl" style="color: #ffffff;"></i>
@elseif($direcao == 'Para a esquerda')
    <i class="fa-solid fa-arrow-left fa-xl" style="color: #ffffff;"></i>
@elseif($direcao == 'Para a direita')
    <i class="fa-solid fa-arrow-right fa-xl" style="color: #ffffff;"></i>
@endif
