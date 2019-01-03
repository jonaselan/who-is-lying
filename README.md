# Who is lying

**Funções necessárias:**
  - O usuário precisa se cadastrar e se logar;

  - O usuário poderá compartilhar uma informação pessoal e ter a possibilidade de marcar se ela é verdadeira ou não;

  - Ao compartilhar irá para um mural que poderá ser visualizado por todos os usuários;

  - Neste post outros podem votar se acreditam ou não na informação;

  - Ter um ranking do usuário de acordo com as assertividades dos usuários classificando entre honesto ou mentiroso;
  
  - Se mais de 3 usuários acertarem o que a informação é, o usuário que deu a informação perde 1 ponto que será dividido entre os 3 e a cada novo usuário o ponto dobra. Exemplo:

    - 3 pessoas acertam = 1 ponto / 3 usuários
    - 4 pessoas acertam = 2 pontos / 4 usuários
    - 5 pessoas acertam = 4 pontos / 5 usuários
    
  - Quando os usuários erram a informação, o ponto é calculado pela quantidade de usuários que erraram (usando o mesmo critério acima), todos os pontos vão para o usuário que deu a informação e é retirado um ponto dos usuários que erraram.
    
  - Cada post tem um tempo de duração de exatamente um dia para ser votado. Quando passa desse tempo, encerram-se as votações;

  - Toda transação deve ter Log e esses Logs poderão ser listados por um login admin;
    