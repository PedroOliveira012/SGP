<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProcedureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Estrutura',
            'Inicio de montagem',
            'Retirar as portas dos ármarios',
            'Definir um método com referências para o processo de Retirar as portas dos armários do fabricante Rittal',
            'Produção',
            'Armário modelo TS8 do fabricante Rittal',
            'Chave de fenda, Martelo de borracha',
            'Sapato de segurança, Luva PU',
            'Com uma chave de fenda, mover os pinos da dobradiça da porta com um movimento de alavanca para cima e para baixo. Caso seja necessário, posicione a chave no lugar e use o martelo para retirar o pino (lembrando de deixar o primeiro pino por ultimo, pois deste jeito ele sustentará todo o peso da porta facilitando a remoção dos outros pinos). Após deslocar todos os pinos, retirar a porta puxando a mesma em direção ao montador (conforme anexo 2.1). Depois de retirar a porta, mover a mesma para um local adequado;',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Estrutura',
            'Inicio de montagem',
            'Retirar as tampas traseiras dos armários',
            'Definir um método com referências para o processo de Retirar as tampas traseiras dos armários do fabricante Rittal',
            'Proudução',
            'Armário modelo TS8 do fabricante Rittal',
            'Bit Torx T30, Parafusadeira',
            'Sapato de segurança, Luva PU',
            'Usando a parafausadeira com o bit Torx T30, desparafusar todos os parafusos que prendem a tampa traseira à estrutura. Depois de desparafusado, puxar levemente a tampa traseira do painel para próximo de si, assim tendo espaço para agarrar a tampa com as mãos. Por fim, levantar a tampa traseira do painel para que ele se desprenda dos ganchos de sustentação na parte superior ao painel, e movendo a tampa em direção ao montador. Após a retirada da tampa traseira, mover a mesma para um local adequado.',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Estrutura',
            'Inicio de montagem',
            'Retirar as placas de montagem dos armários',
            'Definir um método com referências para o processo de Retirar a placa de montagem',
            'Produção',
            'Armário modelo TS8 do fabricante Rittal',
            'Bit Torx T30, Parafusadeira',
            'Sapato de segurança, Luva PU',
            'Remover os parafusos superiores da placa de montagem usando a parafusadeira com o bit torx T30. Ainda na parte superior da placa, levantar os suportes pretos que seguram a placa (Muito cuidado ao fazer isso por que ao levantar os suportes a placa poderá cair sozinha para a frente, por isso sempre que for realizar esse passo, certifique-se que esteja em uma posição segura para segurar a placa se ela cair.). Deslizar a placa pelo guia na parte inferior. Desparafusar e retirar os guias do painel. Instalar os guiar na lateral do armário pelo lado de dentro.',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Estrutura',
            'Inicio de montagem',
            'Retirar o teto do armários',
            'Definir um método com referências para o processo de Retirar o teto do painel',
            'Produção',
            'Armário modelo TS8 do fabricante Rittal',
            'Bit Torx T25(se necessário), Parafusadeira(se necessário), Chave de fenda grande',
            'Sapato de segurança, Luva PU',
            'Passar a chave de fenda por dentro do olhal de içamento e, com um movimento de alavanca, desrosquear o olhal do teto do painel. Caso o painel tenha uma largura igual ou superior a 1000mm, retirar também os outros parafusos que prendem o teto com a parafusadeira com o bit torx T25. Retirar o teto puxando-o para cima.',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Estrutura',
            'Inicio de montagem',
            'Fabricação do pallet',
            'Definir um método com referências para o processo de Fabricar pallet',
            'Produção',
            'Viga de madeira, Tábua de madeira, Prego',
            'Martelo, Trena',
            'Sapato de segurança, Luva PU',
            'Condições para pegar a quantidade certa de vigas no almoxarifado:
                •   Se for apenas uma coluna e esta tiver menos de 1200mm de largura:
                            2 vigas (uma para cada extremidade);
                •   Se for apenas uma coluna com 1200mm de largura:
                            3 vigas (uma central e as outras para cada extremidade);
                •   Se for mais de uma coluna:
                            2 vigas (extremidades da largura total do painel) + 1 viga a cada 1200mm;
            ',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Estrutura',
            'Inicio de montagem',
            'Montagem das bases soleiras no pallet',
            'Definir um método com referências para o processo de Montagem da base soleira',
            'Produção',
            'Elementos p/ base soleira frontal e traseiro modelo VX, Chapas laterais para a base soleira modelo VX',
            'Bit Torx T30, Parafusadeira',
            'Sapato de segurança, Luva PU',
            'Encaixar as chapas laterais no elemento de canto da base soleira até ouvir um click. Parafusar as laterais e os elementos frontais usando a parafusadeira com o bit torx T30.',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Estrutura',
            'Inicio de montagem',
            'Montagem de toda a estrutura em cima da base soleira',
            'Definir um método com referências para o processo de Montagem de estrutura do armário à base soleira',
            'Produção',
            'Base soleira montada, Estrutura do armário, Cantoneira (em caso de junção de painéis)',
            'Parafusadeira, Broca escalonada, Torquímetro, Bit Torx T30, Chave de fenda',
            'Sapato de segurança, Luva PU',
            '1 coluna:
                - Alargar o suporte plastico usando a parafusadeira com a broca escalonada até chegar  no relevo do buraco do suporte;
                - Em 2 pessoas colocar a estrutura em cima da base certificando-se de alinhar o furo da estrutura com a soleira;
                - Fixar os parafusos da base na estrutura sem torqueá-los;
            JUNÇÃO:
            2 colunas:
                - Passar a espuma de vedação na lateral que irá se juntar com o outro painel, tendo o cuidado de facear corretamente a espuma na lateral para garantir bom acabamento e o grau de proteção;
                    - Colocar os ângulos de união externos e internos usando uma parafusadeira com o bit torx T30 mantendo o critério de não apertá-los totalmente;
                - No teto, retirar os olhais adjacentes passando a chave de fenda pelo meio do olhal e rotacionando ele para retirá-lo. Instalar cantoneiras;
            3 colunas:
                - Colocar primeiro a coluna do meio e passar a espuma em ambas as laterais do painel e juntar com as outras colunas;
                    - Colocar os ângulos de união externos e internos usando uma parafusadeira com o bit torx T30 mantendo o critério de não apertá-los totalmente;
                - No teto, retirar os olhais adjacentes passando a chave de fenda pelo meio do olhal e rotacionando ele para retirá-lo. Instalar cantoneiras;
            4 colunas:
                - Escolha uma extremidade para começar montando, e colocar a espuma sempre no lado que a próxima coluna será instalada;
                    - Colocar os ângulos de união externos e internos usando uma parafusadeira com o bit torx T30 mantendo o critério de não apertá-los totalmente;
                - No teto, retirar os olhais adjacentes passando a chave de fenda pelo meio do olhal e rotacionando ele para retirá-lo. Instalar cantoneiras;
            ',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Estrutura',
            'Fim de montagem',
            'Fixação da placa de montagem no painel',
            'Definir um método com referência para o processo de Fixação da placa de montagem',
            'Produção',
            'Armário modelo TS8 do fabricante Rittal;',
            'Bit Torx T30, Parafusadeira',
            'Sapato de segurança, Luva PU',
            'Instalar os guias de deslizamento na parte inferior do painel. Apoiar a parte inferior da placa de montagem nos guias previamente instalados e empurrá-la até o final. Levantar os suportes preto na parte superior do painel. Empurrar a parte superior até encostar na estrutura. Abaixar os suportes para segurar a placa. Parafusar a placa na estrutura usando a parafusadeira com o bit torx T30.',
            ' Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Estrutura',
            'Fim de montagem',
            'Instalar as portas no painel',
            'Definir um método com referências para o processo de Instalar portas',
            'Produção',
            'Armário modelo TS8 do fabricante Rittal',
            'Martelo',
            'Sapato de segurança, Luva PU',
            'Apoiar e alinhar corretamente as dobradiças da porta com as da estrutura e encaixar os pinos nas dobradiças.OBS: Pode-se utilizar a mão mesmo para prender os pinos, caso os pinos estejam difíceis de serem deslocados, fazer uso de um martelo.',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Estrutura',
            'Fim de montagem',
            'Instalar os tetos no painel',
            'Definir um método com referências para o processo de Instalar teto',
            'Produção',
            'Armário modelo TS8 do fabricante Rittal',
            'Chave de fenda, Bit Torx T30, Parafusadeira',
            'Sapato de segurança, Luva PU',
            'Posicionar o teto do painel na parte superior da estrutura. Caso a largura do painel seja maior ou igual a 1000mm, usar a parafusasdeira com o bit torx T30 para prender os outros parafusos do teto. Rosquear o olhal de içamento com as arruelas.',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Estrutura',
            'Fim de montagem',
            'Instalar as tampas traseiras no painel',
            'Definir um método com referências para o processo de Instalar a tampa traseira',
            'Produção',
            'Armário modelo TS8 do fabricante Rittal',
            'Bit Torx T30, Parafusadeira',
            'Sapato de segurança, Luva PU',
            'Levantar a placa um pouco acima da altura do painel e suspendê-la nas presilhas superiores. Parafusar a tampa traseira na estrutura usando a parafusadeira com o bit torx T30.',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Estrutura',
            'Fim de montagem',
            'Instalar as laterais no painel',
            'Definir um método com referência para o processo de Instalar laterais',
            'Produção',
            'Armário modelo TS8 do fabricante Rittal',
            'Bit Torx T30, Parafusadeira',
            'Sapato de segurança, Luva PU',
            'Levantar a placa um pouco acima da altura do painel e suspendê-la nas presilhas superiores. Parafusar as laterais na estrutura utilizando a parafusadeira com o bit torx T30.',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Estrutura',
            'Fim de montagem',
            'Instalar fecho nas portas',
            'Definir um método com referências para o processo de Instalar fecho na porta',
            'Produção',
            'Fecho Confort do fabricante Rittal, Botão pulsador do fabricante Rittal',
            'Parafusadeira, Bit Torx T30',
            'Sapato de segurança, Luva PU',
            '- Desparafusar o fecho padrão na porta do armário usando a parafusadeira com o bit torx T25.
            Montando o fecho:
            - Posicionar o botão na parte inferior do fecho e posicionar a placa metállica sobre o botão alinhando os furos para passagem do parafuso (conforme anexo 2);
            Instalando o fecho
            OBS: Para instalá-lo na porta, o fecho deve estar totalmente aberto;
            - A barra de travamento vertical da porta precisa ser alinhada corretamente para a instalação, portanto, o alinhamento deve ter como base a região central da barra onde estão localizados os furos para a fixação do fecho (conforme anexo 3);
            - Posicionando os pinos do fecho no terceiro e quinto furo, alinhe corretamente e fixe o fecho parafusando-o no primeiro e ultimo furo. (usando a parafusadeira com o bit torx T25);
            ',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        // DB::insert('insert into procedures
        //     (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        //     values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        //     array('ARMÁRIO',
        //     'Estrutura',
        //     'Fim de montagem',
        //     'Instalar componentes na porta do painel',
        //     ''
        // ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Estrutura',
            'Fim de montagem',
            'Embalar painel em plastico bolha e stretch',
            'Definir um método com referências para o processo de Embalar o painel',
            'Produção',
            'Plástico bolha, Stretch, Fita adesiva, Espuma preta',
            'N/A',
            'Sapato de segurança, Luva PU',
            'Cortar as espumas e colar com fita adesiva sobre as botoeiras, comutadoras e luminárias na porta do painel. Enrolar o painel com plástico bolha e colar com fita os papéis de informações do projeto, recomendação de transporte e “Cuidado, frágil”.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Oficina',
            'Placa de montagem',
            'Preparar a placa de montagem para a furação',
            'Definir um método com referencias para o processo de Preparar a placa de montagem para a furação',
            'Oficina, Produção',
            'Armário ou quadro em aço carbono ou inox do fabricante Rittal',
            'Chave combinada 24 e 27, Bit Allen 4',
            'Sapato de segurança, Face shield, Protetor auricular, Óculos de segurança, Luva PU',
            'Após a retirada da placa de montagem do quadro ou armário, o funcionário responsável pela retirada deverá levar a placa para a oficina imediatamente. Na oficina, o operador da máquina deverá prendê-la na Router utilizando os sargentos disponíveis (conforme anexo 1) e o bit Allen 4.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Oficina',
            'Placa de montagem',
            'Iniciar o processo de furação da placa de montagem',
            'Definir um método com referencias para o processo de Inicio da furação da placa de montagem',
            'Oficina',
            'Placa de montagem',
            'Parafusadeira, Macho M4, Macho M5, Macho M6, Macho M8, Broca 3.2, Broca 4.2, Broca 4.5, Broca 5.2, Broca 7.2, Chave gancho com pino, Chave de boca 24, Chave de boca 27',
            'Sapato de segurança, Face shield, Protetor auricular, Óculos de segurança, Luva PU',
            '- Através do software Mach3, poderão ser selecionados os programas de acordo com as dimensões das brocas e dos furos (3.2, 4.2, 4.5, 5.2 e 7.2 milimetros);
            - Ao selecionar qual broca será utilizada, usando a chave de boca 27 e a chave gancho com pino, desrosquear o suporte da pinça da broca;
            - Instalar a pinça apropriada junto com a broca (sempre um número maior do que o tamanho da broca) conforme anexo 2;
            - Dar o start no programa e supervisionar a trajetória de furação;
            - Brocas:
                - Broca 3.2 (M4): Utilizada para fixação do disjuntor na placa, pode ser passada em um único passo;
                - Broca 4.2 (M5):  Utilizada para fixação do trilho na placa, pode ser passada em um único passo;
                - Broca 4.5: Utilizada para fixação das canaletas, pode ser passada em um único passo;
                - Broca 5.2 (M6): Utilizada para fixação de CLPs e Inversores, deve ser feita em dois passos, primeiro passo com a 4.5 e em seguida com a 5.2;
                - Broca 7.2 (M8): Utilizada para fixação de componentes e barramento, deve ser feita em três passos, primeiro passo com a 4.5, segundo passo com a 5.2 e por fim a 7.2;
                - Depois de passar todas as brocas necessárias, identificar a placa escrevendo na fita crepe com marcador permanente o número de projeto que aquela placa pertence;
            ',
            'N/A'
        ));


        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Oficina',
            'Placa de montagem',
            'Cortar trilho',
            'Definir um método com referencias para o processo de Cortar trilho',
            'Produção',
            'Trilho Din 35x15mm do fabricante Weidmuller',
            'Guilhotina para cortar trilhos',
            'Sapato de segurança, Luva PU',
            'Procurar na oficina por sobras de trilho para serem reutilizadas, caso não ache uma com o tamanho necessário o funcionário deve pedir por trilho no Almoxarifado. Com o trilho em mãos, analisar as extremidades do trilho, caso uma delas se pareça com o anexo 1, então o funcionário poderá soltar a guia de metragem e prendê-la na dimensão desejada, inserir o trilho no rasgo central da guilhotina e abaixar a alavanca para cortar o trilho. Caso nenhuma das pontas se pareça com o anexo 1 , então deverá ser realizado o processo de zerar o trilho. Para zerar o trilho, o funcionário irá inserir a ponta no rasgo central da guilhotina até o meio do furo mais próximo e abaixar a alavanca para cortar a ponta.',
            'N/A'

        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Oficina',
            'Placa de montagem',
            'Instalar trilho',
            'Definir um método com referencias para o processo de Instalar trilho',
            'Produção, Oficina',
            'Trilho Din 35x15mm do fabricante Weidmuller (já cortado na medida certa), Parafuso Torx sextavado M5x10',
            'Parafusadeira, Bit Torx T25',
            'Sapato de segurança, Luva PU',
            'Tendo como base o layout do projeto na página de trilhos, posicionar os trilhos no devido lugar e parafusar os trilhos usando o parafuso e a parafusadeira com Bit Torx T25.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Oficina',
            'Placa de montagem',
            'Cortar canaleta',
            'Definir um método com referencias para o processo de Cortar canaleta que será instalada diretamente na placa de montagem',
            'Produção, Oficina',
            'Canaleta plastica do fabricante Dutoplast',
            'Guilhotina de bancada para canaleta, Torquesa',
            'Sapato de segurança, Luva PU',
            'Antes de medir a canaleta, ela deverá ser zerada para que os furos da placa coincidam com os da própria canaleta. Para zerar a canaleta, posicionar a canaleta na lâmina da guilhotina e caso seja necessário, remover os dentes que estiverem atrapalhando o processo de corte. Depois de posicionada, observar o furo menor da canaleta de modo que a parte escura do protetor da lâmina esteja visível e rente. Depois de zerada, medir e cortar a canaleta no tamanho apropriado Após cortar a canaleta, usando a torquesa dar um acabamento na ponta da canaleta.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Oficina',
            'Placa de montagem',
            'Instalar canaleta',
            'Definir um método com referencias para o processo de Instalar canaleta',
            'Produção, Oficina',
            'Canaleta plastica do fabricante Dutoplast (já cortadas nas medidas corretas), Rebite de plástico',
            'Tarugo, Martelo',
            'Sapato de segurança, Luva PU',
            'Seguindo o layout de montagem na página de canaleta, posicionar as canaletas no devido lugar se orientando pelas tag e comprimentos disponíveis na tabela. (É necessário lembrar que o lado correto da canaleta é quando os furos menores coincidem com a furação na placa). Para instalar a canaleta, é necessário pegar um rebite de plástico, o tarugo e o martelo. Coloque o pino do rebite no buraco do tarugo e martelar o rebite na placa. Retire o tarugo e com a outra extremidade martelar o pino para que a canaleta seja presa.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Oficina',
            'Porta',
            'Fazer marcações na porta, teto ou flange',
            'Definir um método com referencias para o processo de Fazer marcações na porta, teto ou flange',
            'Oficina',
            'Porta, teto ou flange de quadros ou armarios do fabricante Rittal',
            'Trena, Lápis, Fita crepe',
            'Sapato de segurança, Luva PU',
            'O funcionário receberá do coordenador da produção, o layout externo das portas com as medidas para instalar cada componente. Primeiramente, o funcionário deverá procurar pelas portas, tetos ou flanges referente ao projeto e levá-los para a oficina. Na oficina ele deverá colocar a porta sobre dois cavaletes para que assim ela fique em uma altura confortável para a realização do processo. Seguindo as medidas no layout, riscar a lápis os devidos lugares que os componentes serão instalados. Passar fita crepe no contorno de cada rasgo retangular para proteger a porta. Caso a porta seja de inox, a fita será passada onde o contorno será feito e riscado por cima da fita.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Oficina',
            'Porta',
            'Fazer recorte e furação na porta, teto ou flange',
            'Definir um método com referencias para o processo de Fazer recorte e furação na porta, teto ou flange',
            'Oficina',
            'Porta, teto ou flange de armários ou quadros do fabricante Rittal',
            'Parafusadeira, Broca escalonada, Broca 12mm, Broca 20mm, Alicate hidráulico de furação, Estampo 22mm, Estampo 30.5, Estampo 43mm, Serra tico tico, Esmerilhadeira (para peças em inox), Tinta RAL 7035, Verniz (para peças em inox)',
            'Sapato de segurança, Luva PU, Óculos de proteção, Face shield, Protetor auricular',
            '- Com as marcações feitas, para cada componente será utilizada uma ferramenta diferente:
                - Botoeiras e luminárias:
                    - Fazer um furo no centro da marcação usando a parafusadeira com a broca de 12mm;
                    - Rosquear o vergalhão menor no alicate e encaixar na outra ponta o negativo da matriz de 22mm;
                    - Feito isso, passe o vergalhão pelo furo e rosqueie na ponta o positivo da matriz até mais ou menos umas 3 linhas da rosca do vergalhão ficarem expostas;
                    - Ative a pressão e bombeie até que o corte seja feito;
                    - Terminado o corte, libere a pressão e desrosqueie a matriz;
                    - Retire o material de dentro da matriz e descarte-o;
                - Teste de tensão:
                    - Fazer um furo no centro da marcação usando a parafusadeira com a broca de 20mm;
                    - Rosquear a menor ponta do vergalhão maior no alicate e encaixar na outra ponta o negativo da matriz de 30.5mm;
                    - Feito isso, passe o vergalhão pelo furo e rosqueie na ponta o positivo da matriz até mais ou menos umas 3 linhas da rosca do vergalhão ficarem expostas;
                    - Ative a pressão e bombeie até que o corte seja feito;
                    - Terminado o corte, libere a pressão e desrosqueie a matriz;
                    - Retire o material de dentro da matriz e descarte-o;
                - Manopla rotativa do disjuntor:
                    - Fazer um furo no centro da marcação usando a parafusadeira com a broca de 20mm;
                    - Rosquear a menor ponta do vergalhão maior no alicate e encaixar na outra ponta o negativo da matriz de 43mm;
                    - Feito isso, passe o vergalhão pelo furo e rosqueie na ponta o positivo da matriz até mais ou menos umas 3 linhas da rosca do vergalhão ficarem expostas;
                    - Ative a pressão e bombeie até que o corte seja feito;
                    - Terminado o corte, libere a pressão e desrosqueie a matriz;
                    - Retire o material de dentro da matriz e descarte-o;
                - Rasgos retangulares (carbono):
                    - Utilizando a parafusadeira com a broca escalonada, fazer um furo perto dos vertices de modo que a serra da tico tico passe pelo furo;
                    - Com a serra devidamente presa, passe ela pelas marcações para fazer o recorte;
                - Rasgos retangulares (inox):
                    - Usar a esmerilhadeira para fazer o rasgo seguindo as guias feitas previamente;
                - Feito isso, deve ser feito o acabamento nos recortes com tinta na peça feita em aço carbono e verniz na de inox.',
            'N/A'
        ));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('ARMÁRIO',
        // 'Oficina', 'Teto', 'Fazer marcações necessárias no teto', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('ARMÁRIO', 'Oficina', 'Teto', 'Fazer recorte e furação no teto', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('ARMÁRIO', 'Produção', 'Fabricação', 'Tirar medidas para a fabricação dos barramentos', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('ARMÁRIO', 'Produção', 'Fabricação', 'Fabricação dos barramentos', ''));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Produção',
            'Fabricação',
            'Fabricação dos cabos de potência',
            'Definir um método com referências para o processo de Fabricação de cabos de potência',
            'Produção',
            'Cabo 2,5mm² preto, Terminal ilhós 2,5 cinza, Luva para anilha, Anilha de identificação',
            'Alicate Crimper, Prensa terminal',
            'Sapato de segurança, Luva PU',
            'Medir o tamanho do cabo de um ponto a outro, deixando um colo (sobra) na canaleta para caso futuramente precise fazer alterações. Cortar o cabo no tamanho medido (caso precise de vários cabos de mesmo tamanho, pode-se usar a máquina CUTFOX 10 para realização do trabalho). Se for levado a conexão a mola, somente decapar o cabo será necessario. Se for levado a conexão por parafuso, a ponta do cabo deverá ser crimpada com terminal ilhós utilizando o alicate prensa terminal. Após finalizar a confeccção do cabo, colocar luva plástica no cabo e anilha de identificação na luva.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Produção',
            'Fabricação',
            'Fabricação dos cabos de comando',
            'Definir um método com referências para o processo de Fabricação de cabos de comando',
            'Produção',
            'Cabo 0,5mm vermelho, Terminal ilhós 0,5mm branco, Luva para anilha, Anilha de identificação',
            'Alicate Crimper, Prensa de terminal',
            'Sapato de segurança, Luva PU',
            'Medir o tamanho do cabo de um ponto a outro, deixando um colo (sobra) na canaleta para caso futuramente precise fazer alterações e se for à porta para que o cabo não fique esticado. Cortar o cabo no tamanho medido (caso precise de vários cabos de mesmo tamanho, pode-se usar a máquina CUTFOX 10 para realização do trabalho). Decapar a ponta do cabo e se for levado a terminal com mola não se deve prensar o terminal. Se for levado a terminal com parafuso, então pegar um terminal 0,5mm branco, colocá-lo na ponta do decapada do cabo e prensar o terminal utilizando a prensa. Para uma maior agilidade, pode-se usar a máquina CF 3000-2,5 que automatiza o processo de decapar e prensar o terminal na ponta do cabo. Após finalizar a confeccção do cabo, colocar luva plástica no cabo e anilha de identificação na luva.',
            'N/A'
        ));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('ARMÁRIO', 'Produção', 'Fabricação', 'Fabricação de chapa de aço para instalação de reatores no chão do painel', ''));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Produção',
            'Instalação',
            'Fixação dos componentes na placa de montagem',
            'Definir um método com referências para o processo de Fixação dos componentes na placa de montagem',
            'Produção',
            'Componentes que serão instalados nos trilhos do painel;',
            'N/A',
            'Sapato de segurança, Luva PU',
            'Seguindo o layout do painel disponível no projeto impresso, colocar os componentes nos trilhos instalados na placa de montagem',
            'N/A'
        ));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('ARMÁRIO', 'Produção', 'Instalação', 'Fixação dos componentes nas portas do painel', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('ARMÁRIO', 'Produção', 'Instalação', 'Fixação das chapas de aço para instalação dos TPs de medição', ''));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Produção',
            'Instalação',
            'Conexão dos cabos de potência nos componetes',
            'Definir um método com referências para o processo de Conexão dos cabos de potência',
            'Produção',
            'Cabos de potência',
            'Chave Finder (para os contatos do tipo mola), Chave de fenda (para os contatos do tipo parafuso)',
            'Sapato de segurança, Luva PU',
            'Com base no diagrama e no layout, identificar os componentes que estarão ligados pelo cabo e o cabo que será ligado.',
            'Retirado do projeto 103545.00.P-22 - CPW - PAINÉIS ELÉTRICOS PROJETO DRY MIX, diagrama 103545.05.P-22E01-C - CCM CLP DRYMIX, página 38'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Produção',
            'Instalação',
            'Conexão dos cabos de comando nos componentes',
            'Definir um método com referências para o processo de Conexão dos cabos de comando',
            'Produção',
            'Cabos de comando',
            'Chave Finder (para os contatos do tipo mola), Chave de fenda (para os contatos do tipo parafuso)',
            'Sapato de segurança, Luva PU',
            'Com base no diagrama e no layout, identificar os componentes que serão ligados pelo cabo (de onde ele sai e para onde vai) e qual o cabo que será ligado',
            'Retirado do projeto 103545.00.P-22 - CPW - PAINÉIS ELÉTRICOS PROJETO DRY MIX, diagrama 103545.05.P-22E01-C - CCM CLP DRYMIX, página 78'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Produção',
            'Instalação',
            'Conexão dos cabos de rede nos componentes',
            'Definir um método com referências para o processo de Conexão dos cabos de rede',
            'Produção',
            'Cabo de rede do fabricante Rockwell',
            'N/A',
            'Sapato de segurança, Luva PU',
            'Com base no diagrama e no layout, identificar os componentes que serão ligados pelo cabo (de onde ele sai e para onde vai) e qual o cabo que será ligado',
            'Retirado do projeto 103545.00.P-22 - CPW - PAINÉIS ELÉTRICOS PROJETO DRY MIX, diagrama 103545.05.P-22E01-C - CCM CLP DRYMIX, página 64'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Produção',
            'Pendências',
            'Retirar pendência',
            'Definir um método com referencias para o processo de Retirar pendência',
            'Produção',
            'N/A',
            'N/A',
            'Sapato de segurança, Luva PU',
            'A ser definido',
            'N/A'
        ));

        // DB::insert('insert into procedures
        //     (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        //     values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        //     array('ARMÁRIO',
        //     'Produção',
        //     'Pendencias',
        //     'Retirar pendencia de anilhas',
        //     'Definir um método com referências para o processo de Retirar pendência de anilha',
        //     'Produção',
        //     'Anilha de identificação',
        //     'N/A',
        //     'Sapato de segurança, Luva PU',
        //     'Na folha de pendências estará escrito todas as anilhas que estão faltando, então o que se deve fazer é transcrever essas anilhas em um pedaço de papel com o número do projeto e o nome do funcionário e entregar no almoxarifado. Depois de impresso, um almoxarife irá entregar as anilhas impressas para a pessoa cujo nome estiver no papel. Com as anilhas em mãos, procurar pelos cabos que precisam ser anilhados e colocar as anilhas nas devidas luvas.',
        //     'N/A'
        // ));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('ARMÁRIO', 'Produção', 'Pendencias', 'Retirar pendencia de barramento', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('ARMÁRIO', 'Produção', 'Pendencias', 'Retirar pendencia de componentes', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('ARMÁRIO', 'Produção', 'Pendencias', 'Retirar pendencia de cabos', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('ARMÁRIO', 'Produção', 'Pendencias', 'Retirar pendencia de estrutura', ''));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Estrutura',
            'Inicio de montagem',
            'Retirar as portas do quadro (Aço carbono)',
            'Definir um método com referências para o processo de Retirar a porta do quadro feito em aço carbono',
            'Produção',
            'Caixa metálica básica AX em chapa de aço do fabricante Rittal',
            'Chave de fenda, Martelo',
            'Sapato de segurança, Luva PU',
            'Com uma chave de fenda, coloque a ponta dela no rebaixo do pino e deslize o pino pela dobradiça e retire-o. Caso o pino esteja esteja difícil de ser retirado, posicione a chave de fenda para retirar e use o martelo para extrair o pino. Retire a porta.',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Estrutura',
            'Inicio de montagem',
            'Retirar as portas do quadro (Aço inox)',
            'Definir um método com referências para o processo de Retirar a porta do quadro feito em aço inox',
            'Produção',
            'Caixa metálica básica AX em chapa de aço ou aço inox do fabricante Rittal',
            'Chave de fenda',
            'Sapato de segurança, Luva PU',
            'Retire as presilhas dos pinos da dobradiça e guarde-as. Com uma chave de fenda, coloque a ponta dela no rebaixo do pino e, com movimento rotativo, deslize o pino pela dobradiça e retire-o. Retire a porta.',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Estrutura',
            'Inicio de montagem',
            'Retirar as flanges do quadro',
            'Definir um método com referências para o processo de Retirar a flange do quadro',
            'Produção',
            'Caixa metálica básica AX em chapa de aço do fabricante Rittal',
            'Parafusadeira, Bit Torx T25',
            'Sapato de segurança, Luva PU',
            'Usando uma parafusadeira com um bit torx T25, desparafusar os parafusos que prendem a flange à estrutura da caixa',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Estrutura',
            'Inicio de montagem',
            'Retirar a placa de montagem',
            'Definir um método com referências para o processo de Retirar a placa de montagem do quadro',
            'Produção',
            'Caixa metálica AX em chapa de aço ou aço inox',
            'Chave canhão 13mm',
            'Sapato de segurança, Luva PU',
            'Com a chave canhão 13mm, desrosquear as porcas que prendem a placa ao quadro. Deixe a placa tombar e segure ela para que não caia. Levante a placa e retire ela do painel.',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Estrutura', 'Inicio de montagem', 'Fabricação de pallet', ''));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Estrutura',
            'Fim de montagem',
            'Fixação da placa de montagem no quadro',
            'Definir um método com referência para o processo de Fixação da placa de montagem',
            'Produção',
            'Caixa metálica AX em chapa de aço ou aço inox do fabricante Rittal',
            'Parafusadeira, Bit Torx T25, Chave de boca 13',
            'Sapato de segurança, Luva PU',
            'Colocar o parafuso com flange nos furos que possuem um ressalto para a parte interna do painel. Apoiar primeiramente a parte inferior da placa de montagem e em seguida encaixá-la com os parafusos superiores (conforme anexo 2). Colocar as porcas M8 para fixação completa da placa de montagem (conforme anexo 3).',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Estrutura',
            'Fim de montagem',
            'Instalar as portas no quadro (carbono)',
            'Definir um método com referências para o processo de Instalar a porta no quadro feito em aço carbono',
            'Produção',
            'Caixa AX do fabricante Rittal',
            'Chave de fenda, Martelo de borracha (se necessário)',
            'Sapato de segurança, Luva PU',
            'Retirar a presilha mais próxima da ponta dos pinos e guardar elas. Posicionar a porta alinhando os furos da dobradiça. Inserir os pinos e colocar novamente a presilha.',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Estrutura',
            'Fim de montagem',
            'Instalar as portas no quadro (inox)',
            'Definir um método com referências para o processo de Instalar a porta no quadro feito em aço inox',
            'Produção',
            'Caixa AX do fabricante Rittal',
            'Chave de fenda, Alicate universal, Martelo de borracha (se necessário)',
            'Saparo de segurança, Luva PU',
            'Posicionar a porta alinhando os furos da dobradiça (conforme anexo 1.1). Inserir os pinos e colocar novamente a presilha (conforme anexo 1.1) Inserir a presilha da ponta dos pinos com o auxilio do alicate.',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Estrutura',
            'Fim de montagem',
            'Instalar a flange no quadro',
            'Definir um método com referências para o processo de Instalar flange no quadro',
            'Produção',
            'Caixa metálica AX em chapa de aço do fabricante Rittal',
            'Parafusadeira, Bit Torx T25',
            'Sapato de segurança, Luva PU',
            'Usando a parafusadeira com bit torx T25, parafusar os parafusos para fixar a flange à estrutura da caixa',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Estrutura',
            'Fim de montagem',
            'Instalar fecho na porta do quadro',
            'Definir um método com referências para o processo de Instalar fecho no quadro',
            'Produção',
            'Caixa metálica básica AX em chapa de aço do fabricante Rittal, Fecho Comfort AX do fabricante Rittal',
            'Parafusadeira, Bit Torx T25, Chave philips, Chave de fenda',
            'Sapato de segurança, Luva PU',
            'Removendo o fecho padrão:
            - Desparafusar os parafusos, usando a parafusadeira com o bit torx T25, que prendem a flange e a placa de cobertura do mecanismo de trava da porta (conforme anexo A1);
            - Retirar a engrenagem e as hastes do mecanismo (conforme anexo A2);
            - Desparafuse o fecho com a parafusadeira e bit torx T25 e retire-o (conforme anexo A3);
            Instalando o novo fecho:
            - Coloque o novo fecho de modo que o pino do fecho se encaixe do suporte que está na porta (conforme anexo B1);
            - Posicione as hastes no suporte que está na porta, se atentando para colocar a haste maior do lado direito e a menor no lado esquerdo do suporte (conforme anexo B2);
            - Encaixe novamente a engrenagem e parafuse a placa de cobertura e a flange (conforme anexo B3)',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Estrutura',
            'Fim de montagem',
            'Aterramento do quadro (Aço carbono)',
            'Definir um método com referências para o processo de Aterramento do quadro',
            'Produção',
            'Caixa metálica AX em chapa de aço do fabricante Rittal, Cabo 6mm² verde e amarelo, Terminal olhal M8, Terminal olhal M6, Arruela de contato, Arruela estriada, Porca M8, Parafuso M6x12 cabeça abaulada',
            'Chave de fenda, Chave catraca, Soquete 10mm',
            'Sapato de segurança, Luva PU',
            'Confecção do cabo:
            - Pegue o cabo 6mm² e meça do parafuso cobreado no lado direito do painel até a parte inferior do trilho da porta direita próximo da dobradiça do painel, de forma que o cabo não fique muito esticado;
            - Corte o cabo na medida, e decape as duas pontas;
            - Em uma ponta coloque um terminal olhal M6 e na outra um terminal olhal M8, prense os dois usando a prensa;
            Instalando o cabo:
            - No parafuso cobreado do lado direito, colocar na sequência uma arruela de contato, o terminal olhal do M8 do cabo, uma arruela estriada e por fim uma porca M8;
            - No parafuso M6, colocar na sequência uma arruela estriada, o terminal olhal M6 do cabo, uma arruela de contato e por fim parafusar no primeiro furo, de baixo para cima (conforme anexo 2.1)',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Estrutura',
            'Fim de montagem',
            'Aterramento do quadro (Aço inox)',
            'Definir um método com referências para o processo de Aterramento do quadro',
            'Produção',
            'Caixa metálica AX em aço inox do fabricante Rittal, Arruela lisa, Arruela de pressão, Parafuso M6 x 12, Terminal olhal M8, Terminal olhal M6, Porca M8,
            Cabo 6mm² verde e amarelo',
            'Chave catraca, Soquete 13mm, Soquete 10mm, Alicate Crimper, Prensa terminal olhal',
            'Sapato de segurança , Luva PU',
            'Confecção do cabo:
            - Pegue o cabo 6mm² e meça do furo M6 no lado direito do painel até o primeiro parafuso da porta direita, de forma que o cabo não fique muito esticado. Corte o cabo na medida, e decape as duas pontas.  Em uma ponta coloque um terminal olhal M6 e na outra um terminal olhal M8, prense os dois usando a prensa.
            Instalando o cabo:
            - No furo M6, colocar na sequência uma arruela lisa, o terminal olhal M6 do cabo, outra arruela lisa, uma arruela de pressão e por fim o parafuso M6x12. Na porta, colocar na sequência uma arruela lisa, o terminal olhal M8 do cabo, outra arruela lisa, uma arruela de pressão e por fim a porca M8.',
            'Manual de montagem e operação do próprio painel fornecido pelo fabricante'
        ));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Estrutura', 'Fim de montagem', 'Instalar os componentes na porta do quadro', ''));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Estrutura',
            'Fim de montagem',
            'Embalar quadro',
            'Definir um método com referências para o processo de Embalar o quadro',
            'Produção',
            'Pallet, Presilha para crimpagem, Fita para arquear preta, Plástico bolha, Stretch, Espuma preta, Fita adesiva',
            'Furadeira, Serra copo, Arqueador de fita',
            'Sapato de segurança, Luva PU',
            'Usando a furadeira com a serra copo, faça 4 furos no pallet para a passagem da fita. Posicionar o quadro no centro do pallet. Colocar espuma nas botoeiras, luminárias, comutadoras e acionamentos de disjuntores na porta e colar com fita adesiva. Enrolar o quadro em plástico bolha e colar os papéis de informações do projeto, recomendações de transporte e “Cuidado, frágil”. Enrolar o quadro com stretch. Passar a fita para arquear preta pelos buracos do pallet e colocar espuma nas arestas superiores do quadro.
            Crimpando a fita:
            Abrir o prendedor e passar a fita por baixo, logo em seguida trave-o. Passe a fita por cima do prendedor, por dentro da faca e por dentro do esticador. Tensionar a fita rotacionando a catraca. Muito cuidado para não tensionar demasiadamente e estourar a fita. Colocar o selo e abaixe o “alicate” do arqueador para iniciar o processo de arqueação. Abra as alavancas para apertar o selo. O arqueador corta automaticamente a fita.',
            'N/A'
        ));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Oficina', 'Placa de montagem', 'Preparar a placa de montagem', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Oficina', 'Placa de montagem', 'Inicio da furação da placa de montagem', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Oficina', 'Placa de montagem', 'Fazer rosca nos furos', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Oficina', 'Placa de montagem', 'Cortar trilho de acordo com o layout de fabricação', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Oficina', 'Placa de montagem', 'Instalar trilho', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Oficina', 'Placa de montagem', 'Cortar canaleta de acordo com o layout de fabricação', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Oficina', 'Placa de montagem', 'Instalar canaleta', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Oficina', 'Placa de montagem', 'Posicionar placa de montagem para instalação de componentes', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Oficina', 'Porta', 'Fazer marcações necessárias na porta', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Oficina', 'Porta', 'Fazer recorte e furação na porta', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Oficina', 'Flange', 'Fazer marcações necessárias na flange', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Oficina', 'Flange', 'Fazer recorte e furação na flange', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Produção', 'Fabricação', 'Tirar medidas para fabricação de barramento', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Produção', 'Fabricação', 'Fabricação de barramento', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Produção', 'Fabricação', 'Fabricação dos cabos de potência', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Produção', 'Fabricação', 'Fabricação dos cabos de comando', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Produção', 'Instalação', 'Fixação dos componentes na placa de montagem', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Produção', 'Instalação', 'Fixação dos componentes na porta do quadro', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Produção', 'Instalação', 'Conexão dos cabos de potência nos componentes', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Produção', 'Instalação', 'Conexão dos cabos de comando nos componentes', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Produção', 'Instalação', 'Conexão dos cabos de rede nos componentes', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Produção', 'Pendencias', 'Retirar pendencia de TAGs', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Produção', 'Pendencias', 'Retirar pendencia de anilha', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Produção', 'Pendencias', 'Retirar pendencia de barramento', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Produção', 'Pendencias', 'Retirar pendencia de componentes', ''));

        // DB::insert('insert into procedures
        // (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        // values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        // array('QUADRO', 'Produção', 'Pendencias', 'Retirar pendencia de cabos', ''));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Oficina',
            'Placa de montagem',
            'Preparar a placa de montagem para a furação',
            'Definir um método com referencias para o processo de Preparar a placa de montagem para a furação',
            'Oficina, Produção',
            'Armário ou quadro em aço carbono ou inox do fabricante Rittal',
            'Chave combinada 24 e 27, Bit Allen 4',
            'Sapato de segurança, Face shield, Protetor auricular, Óculos de segurança, Luva PU',
            'Após a retirada da placa de montagem do quadro ou armário, o funcionário responsável pela retirada deverá levar a placa para a oficina imediatamente. Na oficina, o operador da máquina deverá prendê-la na Router utilizando os sargentos disponíveis (conforme anexo 1) e o bit Allen 4.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Oficina',
            'Placa de montagem',
            'Iniciar o processo de furação da placa de montagem',
            'Definir um método com referencias para o processo de Inicio da furação da placa de montagem',
            'Oficina',
            'Placa de montagem',
            'Parafusadeira, Macho M4, Macho M5, Macho M6, Macho M8, Broca 3.2, Broca 4.2, Broca 4.5, Broca 5.2, Broca 7.2, Chave gancho com pino, Chave de boca 24, Chave de boca 27',
            'Sapato de segurança, Face shield, Protetor auricular, Óculos de segurança, Luva PU',
            '- Através do software Mach3, poderão ser selecionados os programas de acordo com as dimensões das brocas e dos furos (3.2, 4.2, 4.5, 5.2 e 7.2 milimetros);
            - Ao selecionar qual broca será utilizada, usando a chave de boca 27 e a chave gancho com pino, desrosquear o suporte da pinça da broca;
            - Instalar a pinça apropriada junto com a broca (sempre um número maior do que o tamanho da broca) conforme anexo 2;
            - Dar o start no programa e supervisionar a trajetória de furação;
            - Brocas:
                - Broca 3.2 (M4): Utilizada para fixação do disjuntor na placa, pode ser passada em um único passo;
                - Broca 4.2 (M5):  Utilizada para fixação do trilho na placa, pode ser passada em um único passo;
                - Broca 4.5: Utilizada para fixação das canaletas, pode ser passada em um único passo;
                - Broca 5.2 (M6): Utilizada para fixação de CLPs e Inversores, deve ser feita em dois passos, primeiro passo com a 4.5 e em seguida com a 5.2;
                - Broca 7.2 (M8): Utilizada para fixação de componentes e barramento, deve ser feita em três passos, primeiro passo com a 4.5, segundo passo com a 5.2 e por fim a 7.2;
                - Depois de passar todas as brocas necessárias, identificar a placa escrevendo na fita crepe com marcador permanente o número de projeto que aquela placa pertence;
            ',
            'N/A'
        ));


        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Oficina',
            'Placa de montagem',
            'Cortar trilho',
            'Definir um método com referencias para o processo de Cortar trilho',
            'Produção',
            'Trilho Din 35x15mm do fabricante Weidmuller',
            'Guilhotina para cortar trilhos',
            'Sapato de segurança, Luva PU',
            'Procurar na oficina por sobras de trilho para serem reutilizadas, caso não ache uma com o tamanho necessário o funcionário deve pedir por trilho no Almoxarifado. Com o trilho em mãos, analisar as extremidades do trilho, caso uma delas se pareça com o anexo 1, então o funcionário poderá soltar a guia de metragem e prendê-la na dimensão desejada, inserir o trilho no rasgo central da guilhotina e abaixar a alavanca para cortar o trilho. Caso nenhuma das pontas se pareça com o anexo 1 , então deverá ser realizado o processo de zerar o trilho. Para zerar o trilho, o funcionário irá inserir a ponta no rasgo central da guilhotina até o meio do furo mais próximo e abaixar a alavanca para cortar a ponta.',
            'N/A'

        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Oficina',
            'Placa de montagem',
            'Instalar trilho',
            'Definir um método com referencias para o processo de Instalar trilho',
            'Produção, Oficina',
            'Trilho Din 35x15mm do fabricante Weidmuller (já cortado na medida certa), Parafuso Torx sextavado M5x10',
            'Parafusadeira, Bit Torx T25',
            'Sapato de segurança, Luva PU',
            'Tendo como base o layout do projeto na página de trilhos, posicionar os trilhos no devido lugar e parafusar os trilhos usando o parafuso e a parafusadeira com Bit Torx T25.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Oficina',
            'Placa de montagem',
            'Cortar canaleta',
            'Definir um método com referencias para o processo de Cortar canaleta que será instalada diretamente na placa de montagem',
            'Produção, Oficina',
            'Canaleta plastica do fabricante Dutoplast',
            'Guilhotina de bancada para canaleta, Torquesa',
            'Sapato de segurança, Luva PU',
            'Antes de medir a canaleta, ela deverá ser zerada para que os furos da placa coincidam com os da própria canaleta. Para zerar a canaleta, posicionar a canaleta na lâmina da guilhotina e caso seja necessário, remover os dentes que estiverem atrapalhando o processo de corte. Depois de posicionada, observar o furo menor da canaleta de modo que a parte escura do protetor da lâmina esteja visível e rente. Depois de zerada, medir e cortar a canaleta no tamanho apropriado Após cortar a canaleta, usando a torquesa dar um acabamento na ponta da canaleta.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Oficina',
            'Placa de montagem',
            'Instalar canaleta',
            'Definir um método com referencias para o processo de Instalar canaleta',
            'Produção, Oficina',
            'Canaleta plastica do fabricante Dutoplast (já cortadas nas medidas corretas), Rebite de plástico',
            'Tarugo, Martelo',
            'Sapato de segurança, Luva PU',
            'Seguindo o layout de montagem na página de canaleta, posicionar as canaletas no devido lugar se orientando pelas tag e comprimentos disponíveis na tabela. (É necessário lembrar que o lado correto da canaleta é quando os furos menores coincidem com a furação na placa). Para instalar a canaleta, é necessário pegar um rebite de plástico, o tarugo e o martelo. Coloque o pino do rebite no buraco do tarugo e martelar o rebite na placa. Retire o tarugo e com a outra extremidade martelar o pino para que a canaleta seja presa.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Oficina',
            'Porta',
            'Fazer marcações na porta, teto ou flange',
            'Definir um método com referencias para o processo de Fazer marcações na porta, teto ou flange',
            'Oficina',
            'Porta, teto ou flange de quadros ou armarios do fabricante Rittal',
            'Trena, Lápis, Fita crepe',
            'Sapato de segurança, Luva PU',
            'O funcionário receberá do coordenador da produção, o layout externo das portas com as medidas para instalar cada componente. Primeiramente, o funcionário deverá procurar pelas portas, tetos ou flanges referente ao projeto e levá-los para a oficina. Na oficina ele deverá colocar a porta sobre dois cavaletes para que assim ela fique em uma altura confortável para a realização do processo. Seguindo as medidas no layout, riscar a lápis os devidos lugares que os componentes serão instalados. Passar fita crepe no contorno de cada rasgo retangular para proteger a porta. Caso a porta seja de inox, a fita será passada onde o contorno será feito e riscado por cima da fita.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Oficina',
            'Porta',
            'Fazer recorte e furação na porta, teto ou flange',
            'Definir um método com referencias para o processo de Fazer recorte e furação na porta, teto ou flange',
            'Oficina',
            'Porta, teto ou flange de armários ou quadros do fabricante Rittal',
            'Parafusadeira, Broca escalonada, Broca 12mm, Broca 20mm, Alicate hidráulico de furação, Estampo 22mm, Estampo 30.5, Estampo 43mm, Serra tico tico, Esmerilhadeira (para peças em inox), Tinta RAL 7035, Verniz (para peças em inox)',
            'Sapato de segurança, Luva PU, Óculos de proteção, Face shield, Protetor auricular',
            '- Com as marcações feitas, para cada componente será utilizada uma ferramenta diferente:
                - Botoeiras e luminárias:
                    - Fazer um furo no centro da marcação usando a parafusadeira com a broca de 12mm;
                    - Rosquear o vergalhão menor no alicate e encaixar na outra ponta o negativo da matriz de 22mm;
                    - Feito isso, passe o vergalhão pelo furo e rosqueie na ponta o positivo da matriz até mais ou menos umas 3 linhas da rosca do vergalhão ficarem expostas;
                    - Ative a pressão e bombeie até que o corte seja feito;
                    - Terminado o corte, libere a pressão e desrosqueie a matriz;
                    - Retire o material de dentro da matriz e descarte-o;
                - Teste de tensão:
                    - Fazer um furo no centro da marcação usando a parafusadeira com a broca de 20mm;
                    - Rosquear a menor ponta do vergalhão maior no alicate e encaixar na outra ponta o negativo da matriz de 30.5mm;
                    - Feito isso, passe o vergalhão pelo furo e rosqueie na ponta o positivo da matriz até mais ou menos umas 3 linhas da rosca do vergalhão ficarem expostas;
                    - Ative a pressão e bombeie até que o corte seja feito;
                    - Terminado o corte, libere a pressão e desrosqueie a matriz;
                    - Retire o material de dentro da matriz e descarte-o;
                - Manopla rotativa do disjuntor:
                    - Fazer um furo no centro da marcação usando a parafusadeira com a broca de 20mm;
                    - Rosquear a menor ponta do vergalhão maior no alicate e encaixar na outra ponta o negativo da matriz de 43mm;
                    - Feito isso, passe o vergalhão pelo furo e rosqueie na ponta o positivo da matriz até mais ou menos umas 3 linhas da rosca do vergalhão ficarem expostas;
                    - Ative a pressão e bombeie até que o corte seja feito;
                    - Terminado o corte, libere a pressão e desrosqueie a matriz;
                    - Retire o material de dentro da matriz e descarte-o;
                - Rasgos retangulares (carbono):
                    - Utilizando a parafusadeira com a broca escalonada, fazer um furo perto dos vertices de modo que a serra da tico tico passe pelo furo;
                    - Com a serra devidamente presa, passe ela pelas marcações para fazer o recorte;
                - Rasgos retangulares (inox):
                    - Usar a esmerilhadeira para fazer o rasgo seguindo as guias feitas previamente;
                - Feito isso, deve ser feito o acabamento nos recortes com tinta na peça feita em aço carbono e verniz na de inox.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Produção',
            'Fabricação',
            'Fabricação dos cabos de potência',
            'Definir um método com referências para o processo de Fabricação de cabos de potência',
            'Produção',
            'Cabo 2,5mm² preto, Terminal ilhós 2,5 cinza, Luva para anilha, Anilha de identificação',
            'Alicate Crimper, Prensa terminal',
            'Sapato de segurança, Luva PU',
            'Medir o tamanho do cabo de um ponto a outro, deixando um colo (sobra) na canaleta para caso futuramente precise fazer alterações. Cortar o cabo no tamanho medido (caso precise de vários cabos de mesmo tamanho, pode-se usar a máquina CUTFOX 10 para realização do trabalho). Se for levado a conexão a mola, somente decapar o cabo será necessario. Se for levado a conexão por parafuso, a ponta do cabo deverá ser crimpada com terminal ilhós utilizando o alicate prensa terminal. Após finalizar a confeccção do cabo, colocar luva plástica no cabo e anilha de identificação na luva.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Produção',
            'Fabricação',
            'Fabricação dos cabos de comando',
            'Definir um método com referências para o processo de Fabricação de cabos de comando',
            'Produção',
            'Cabo 0,5mm vermelho, Terminal ilhós 0,5mm branco, Luva para anilha, Anilha de identificação',
            'Alicate Crimper, Prensa de terminal',
            'Sapato de segurança, Luva PU',
            'Medir o tamanho do cabo de um ponto a outro, deixando um colo (sobra) na canaleta para caso futuramente precise fazer alterações e se for à porta para que o cabo não fique esticado. Cortar o cabo no tamanho medido (caso precise de vários cabos de mesmo tamanho, pode-se usar a máquina CUTFOX 10 para realização do trabalho). Decapar a ponta do cabo e se for levado a terminal com mola não se deve prensar o terminal. Se for levado a terminal com parafuso, então pegar um terminal 0,5mm branco, colocá-lo na ponta do decapada do cabo e prensar o terminal utilizando a prensa. Para uma maior agilidade, pode-se usar a máquina CF 3000-2,5 que automatiza o processo de decapar e prensar o terminal na ponta do cabo. Após finalizar a confeccção do cabo, colocar luva plástica no cabo e anilha de identificação na luva.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Produção',
            'Instalação',
            'Fixação dos componentes na placa de montagem',
            'Definir um método com referências para o processo de Fixação dos componentes na placa de montagem',
            'Produção',
            'Componentes que serão instalados nos trilhos do painel;',
            'N/A',
            'Sapato de segurança, Luva PU',
            'Seguindo o layout do painel disponível no projeto impresso, colocar os componentes nos trilhos instalados na placa de montagem',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Produção',
            'Instalação',
            'Conexão dos cabos de potência nos componetes',
            'Definir um método com referências para o processo de Conexão dos cabos de potência',
            'Produção',
            'Cabos de potência',
            'Chave Finder (para os contatos do tipo mola), Chave de fenda (para os contatos do tipo parafuso)',
            'Sapato de segurança, Luva PU',
            'Com base no diagrama e no layout, identificar os componentes que estarão ligados pelo cabo e o cabo que será ligado.',
            'Retirado do projeto 103545.00.P-22 - CPW - PAINÉIS ELÉTRICOS PROJETO DRY MIX, diagrama 103545.05.P-22E01-C - CCM CLP DRYMIX, página 38'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Produção',
            'Instalação',
            'Conexão dos cabos de comando nos componentes',
            'Definir um método com referências para o processo de Conexão dos cabos de comando',
            'Produção',
            'Cabos de comando',
            'Chave Finder (para os contatos do tipo mola), Chave de fenda (para os contatos do tipo parafuso)',
            'Sapato de segurança, Luva PU',
            'Com base no diagrama e no layout, identificar os componentes que serão ligados pelo cabo (de onde ele sai e para onde vai) e qual o cabo que será ligado',
            'Retirado do projeto 103545.00.P-22 - CPW - PAINÉIS ELÉTRICOS PROJETO DRY MIX, diagrama 103545.05.P-22E01-C - CCM CLP DRYMIX, página 78'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Produção',
            'Instalação',
            'Conexão dos cabos de rede nos componentes',
            'Definir um método com referências para o processo de Conexão dos cabos de rede',
            'Produção',
            'Cabo de rede do fabricante Rockwell',
            'N/A',
            'Sapato de segurança, Luva PU',
            'Com base no diagrama e no layout, identificar os componentes que serão ligados pelo cabo (de onde ele sai e para onde vai) e qual o cabo que será ligado',
            'Retirado do projeto 103545.00.P-22 - CPW - PAINÉIS ELÉTRICOS PROJETO DRY MIX, diagrama 103545.05.P-22E01-C - CCM CLP DRYMIX, página 64'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Produção',
            'Pendências',
            'Retirar pendência',
            'Definir um método com referencias para o processo de Retirar pendência',
            'Produção',
            'N/A',
            'N/A',
            'Sapato de segurança, Luva PU',
            'A ser definido',
            'N/A'
        ));

        // DB::insert('insert into procedures
        //     (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
        //     values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        //     array('QUADRO',
        //     'Produção',
        //     'Pendencias',
        //     'Retirar pendencia de anilhas',
        //     'Definir um método com referências para o processo de Retirar pendência de anilha',
        //     'Produção',
        //     'Anilha de identificação',
        //     'N/A',
        //     'Sapato de segurança, Luva PU',
        //     'Na folha de pendências estará escrito todas as anilhas que estão faltando, então o que se deve fazer é transcrever essas anilhas em um pedaço de papel com o número do projeto e o nome do funcionário e entregar no almoxarifado. Depois de impresso, um almoxarife irá entregar as anilhas impressas para a pessoa cujo nome estiver no papel. Com as anilhas em mãos, procurar pelos cabos que precisam ser anilhados e colocar as anilhas nas devidas luvas.',
        //     'N/A'
        // ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Almoxarifado',
            'Pré-montagem',
            'Preparação dos materiais para montagem',
            'Retirar os materiais das embalagens e colocar tags',
            'Produção',
            'contatores e disjuntores que serão usados no painel',
            'N/A',
            'Sapato de segurança, Luva PU',
            'Desembalar os materiais que serão utilizados na montagem, como contatores e disjuntores, e, se possuírem, instalar os acessórios dos devidos componentes,Colar as tags dos respectivos componentes.',
            'N/A'
        ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Almoxarifado',
            'Pré-montagem',
            'Preparação dos materiais para montagem',
            'Retirar os materiais das embalagens e colocar tags',
            'Produção',
            'contatores e disjuntores que serão usados no painel',
            'N/A',
            'Sapato de segurança, Luva PU',
            'Desembalar os materiais que serão utilizados na montagem, como contatores e disjuntores, e, se possuírem, instalar os acessórios dos devidos componentes,Colar as tags dos respectivos componentes.',
            'N/A'
            ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Armário',
            'Almoxarifado',
            'Pré-montagem',
            'Montagem da régua de bornes',
            'Deixar a régua de bornes preparada para a intalação na placa de montagem',
            'Produção',
            'trilho, bornes',
            'N/A',
            'Sapato de segurança, Luva PU',
            'Com o diagrama em mãos, analisar cuidadosamente quais réguas serão utilizadas no painel (XDI, XDO, XAI, de potência, etc) e montá-las no trilho que ja deve estar cortado no tamanho correto, Após a instalção de todos os bornes, na parte de trás do trilho fazer marcações a cada 200mm com uma caneta piloto preta, isso é necessário para que na hora do montador instalar, ele saber quais bornes retirar para parafusar o trilho na placa de montagem',
            'N/A'
            ));

        DB::insert('insert into procedures
            (tipo, area, processo, titulo, objetivo, areas_envolvidas, material, ferramentas, EPI, descricao, referencias)
            values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            array('Quadro',
            'Almoxarifado',
            'Pré-montagem',
            'Montagem da régua de bornes',
            'Deixar a régua de bornes preparada para a intalação na placa de montagem',
            'Produção',
            'trilho, bornes',
            'N/A',
            'Sapato de segurança, Luva PU',
            'Com o diagrama em mãos, analisar cuidadosamente quais réguas serão utilizadas no painel (XDI, XDO, XAI, de potência, etc) e montá-las no trilho que ja deve estar cortado no tamanho correto, Após a instalção de todos os bornes, na parte de trás do trilho fazer marcações a cada 200mm com uma caneta piloto preta, isso é necessário para que na hora do montador instalar, ele saber quais bornes retirar para parafusar o trilho na placa de montagem',
            'N/A'
            ));
    }
}
