<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../assets/css/card/cartao.css">
    <link rel="stylesheet" href="../assets/css/card/cartao-responsivo.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">  -->
</head>
<body onload="carregado()" >
<?php
  require_once('../libs/header.php');
?>   


    <div class="principal"> <!-- INICIO DO CONTEUDO PRINCIPAL -->
       
      
      <div class="wrapper" id="app">
            <div class="card-form">
              <div class="card-list">
                <div class="card-item" v-bind:class="{ '-active' : isCardFlipped }">
                  <div class="card-item__side -front">
                    <div class="card-item__focus" v-bind:class="{'-active' : focusElementStyle }" v-bind:style="focusElementStyle" ref="focusElement"></div>
                    <div class="card-item__cover">
                      <img
                      v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg">
                    </div>
                    
                    <div class="card-item__wrapper">
                      <div class="card-item__top">
                        <img src="https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/chip.png" class="card-item__chip">
                        <div class="card-item__type">
                          <transition name="slide-fade-up">
                            <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" v-bind:key="getCardType" alt="" class="card-item__typeImg">
                          </transition>
                        </div>
                      </div>
                      <label for="cardNumber" class="card-item__number" ref="cardNumber">
                        <template v-if="getCardType === 'amex'">
                         <span v-for="(n, $index) in amexCardMask" :key="$index">
                          <transition name="slide-fade-up">
                            <div
                              class="card-item__numberItem"
                              v-if="$index > 4 && $index < 14 && cardNumber.length > $index && n.trim() !== ''"
                            >*</div>
                            <div class="card-item__numberItem"
                              :class="{ '-active' : n.trim() === '' }"
                              :key="$index" v-else-if="cardNumber.length > $index">
                              {{cardNumber[$index]}}
                            </div>
                            <div
                              class="card-item__numberItem"
                              :class="{ '-active' : n.trim() === '' }"
                              v-else
                              :key="$index + 1"
                            >{{n}}</div>
                          </transition>
                        </span>
                        </template>
        
                        <template v-else>
                          <span v-for="(n, $index) in otherCardMask" :key="$index">
                            <transition name="slide-fade-up">
                              <div
                                class="card-item__numberItem"
                                v-if="$index > 4 && $index < 15 && cardNumber.length > $index && n.trim() !== ''"
                              >*</div>
                              <div class="card-item__numberItem"
                                :class="{ '-active' : n.trim() === '' }"
                                :key="$index" v-else-if="cardNumber.length > $index">
                                {{cardNumber[$index]}}
                              </div>
                              <div
                                class="card-item__numberItem"
                                :class="{ '-active' : n.trim() === '' }"
                                v-else
                                :key="$index + 1"
                              >{{n}}</div>
                            </transition>
                          </span>
                        </template>
                      </label>
                      <div class="card-item__content">
                        <label for="cardName" class="card-item__info" ref="cardName">
                          <div class="card-item__holder">Nome no cartão</div>
                          <transition name="slide-fade-up">
                            <div class="card-item__name" v-if="cardName.length" key="1">
                              <transition-group name="slide-fade-right">
                                <span class="card-item__nameItem" v-for="(n, $index) in cardName.replace(/\s\s+/g, ' ')" v-if="$index === $index" v-bind:key="$index + 1">{{n}}</span>
                              </transition-group>
                            </div>
                            <div class="card-item__name" v-else key="2">Nome completo</div>
                          </transition>
                        </label>
                        <div class="card-item__date" ref="cardDate">
                          <label for="cardMonth" class="card-item__dateTitle">Validade</label>
                          <label for="cardMonth" class="card-item__dateItem">
                            <transition name="slide-fade-up">
                              <span v-if="cardMonth" v-bind:key="cardMonth">{{cardMonth}}</span>
                              <span v-else key="2">MM</span>
                            </transition>
                          </label>
                          /
                          <label for="cardYear" class="card-item__dateItem">
                            <transition name="slide-fade-up">
                              <span v-if="cardYear" v-bind:key="cardYear">{{String(cardYear).slice(2,4)}}</span>
                              <span v-else key="2">AA</span>
                            </transition>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-item__side -back">
                    <div class="card-item__cover">
                      <img
                      v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg">
                    </div>
                    <div class="card-item__band"></div>
                    <div class="card-item__cvv">
                        <div class="card-item__cvvTitle">CVV</div>
                        <div class="card-item__cvvBand">
                          <span v-for="(n, $index) in cardCvv" :key="$index">
                            *
                          </span>
        
                      </div>
                        <div class="card-item__type">
                            <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" class="card-item__typeImg">
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <form method="post" action="../private/verificarCartao.php" class="card-form__inner" >
                <input type="hidden" name="switch" value="add">
                <div class="card-input">
                  <input type="text" id="cardNumber" class="card-input__input" v-mask="generateCardNumberMask" v-model="cardNumber" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardNumber" autocomplete="off" name="cardNumber" required>
                  <label for="cardNumber" class="card-input__label">Número do cartão</label>
                </div>
                <div class="card-input">
                  <input type="text" id="cardName" class="card-input__input" v-model="cardName" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardName" autocomplete="off" name="cardName" required>
                  <label for="cardName" class="card-input__label">Nome no cartão</label>
                </div>
                <div class="card-form__row">
                  <div class="card-form__col">
                    <div class="card-form__group">
                      <label for="cardMonth" class="card-input__label" id="not-label" >Validade</label>
                      <select class="card-input__input -select" id="cardMonth" v-model="cardMonth" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate" name="cardMonth">
                        <option value="" disabled selected>Mês</option>
                        <option v-bind:value="n < 10 ? '0' + n : n" v-for="n in 12" v-bind:disabled="n < minCardMonth" v-bind:key="n">
                            {{n < 10 ? '0' + n : n}}
                        </option>
                      </select>
                      
                    </div>
                  </div>




                  <div class="card-form__col">
                    <div class="card-form__group">
                      
                      <select class="card-input__input -select" id="cardYear" v-model="cardYear" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate" name="cardYear">
                        <option value="" disabled selected>Ano</option>
                        <option v-bind:value="$index + minCardYear" v-for="(n, $index) in 12" v-bind:key="n">
                            {{$index + minCardYear}}
                        </option>
                      </select>
                    </div>
                  </div>


                  
                  

                  

                  <div class="card-form__col -cvv">
                    <div class="card-input">
                      <input type="text" class="card-input__input" id="cardCvv" name="cardCvv" v-mask="'####'" maxlength="4" v-model="cardCvv" v-on:focus="flipCard(true)" v-on:blur="flipCard(false)" autocomplete="off" required>
                      <label for="cardCvv" class="card-input__label">CVV</label>

                    </div>
                  </div>
                </div>
        
                <button class="card-form__button">
                  Confirmar
                </button>
              </form>
            </div>
            
           
          </div>
        
    </div>  <!-- FIM DO CONTEUDO PRINCIPAL -->
<?php
require_once('../libs/footer.html');
?>

<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
<script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script><script  src="../assets/js/card/cartao.js"></script>
<script src="../assets/js/card/menu.js"></script>

</body>
</html>