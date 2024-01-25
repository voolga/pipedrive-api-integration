<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <title>Task adding custom form</title>
  <link rel="stylesheet" href="styles.css" />
</head>

<body>

  <form class="task-form">
    <div class="container">

      <!-- Block 1: Client -->
      <div class="task-block">
        <h2 class="task-block__header">Client</h2>
        <div class="task-block__wrapper">
          <input name="name" class="task-block__input" type="text" placeholder="Name" required />
          <input name="surname" class="task-block__input" type="text" placeholder="Surname" required />
          <input name="phone" class="task-block__input" type="number" placeholder="Phone number" required />
          <input name="email" class="task-block__input" type="email" placeholder="Email" required />
        </div>
      </div>

      <!-- Block 2: Job type -->
      <div class="task-block">
        <h2 class="task-block__header">Job type</h2>
        <div class="task-block__wrapper">

          <?php
          //GET request
          $api_token = 'ef18432fb61d7e5ed2dfed66422dde735f486eb3';
          $company_domain = 'futurama';
          $url = 'https://' . $company_domain . '.pipedrive.com/api/v1/dealFields?limit=500&api_token=' . $api_token;
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

          $output = curl_exec($ch);
          curl_close($ch);

          $result = json_decode($output, true);

          if ($result && $result['success'] && !empty($result['data'])) {
            foreach ($result['data'] as $field) {
              if ($field['name'] === 'job type') {
                if (isset($field['options']) && is_array($field['options'])) {

                  $optionsHtml = "";
                  foreach ($field['options'] as $option) {

                    $optionsHtml .= "<option value='" . htmlspecialchars($option['label']) . "'>" . htmlspecialchars($option['label']) . "</option>";
                  }

                  $selectHtml = "<select name='task-type' class='task-block__select' required>" . $optionsHtml . "</select>";
                  echo $selectHtml;
                  break;
                } else {
                  echo "Массив 'options' не найден или не является массивом.";
                }
              }
            }
          } else {
            echo "Ошибка или данные отсутствуют";
          }

          if ($result && $result['success'] && !empty($result['data'])) {
            foreach ($result['data'] as $field) {
              if ($field['name'] === 'job source') {
                if (isset($field['options']) && is_array($field['options'])) {

                  $optionsHtml = "";
                  foreach ($field['options'] as $option) {

                    $optionsHtml .= "<option value='" . htmlspecialchars($option['label']) . "'>" . htmlspecialchars($option['label']) . "</option>";
                  }

                  $selectHtml = "<select name='task-source' class='task-block__select' required>" . $optionsHtml . "</select>";
                  echo $selectHtml;
                  break;
                } else {
                  echo "Массив 'options' не найден или не является массивом.";
                }
              }
            }
          } else {
            echo "Ошибка или данные отсутствуют";
          }
          ?>

          <textarea name="task-adds" class="task-block__input task-block__textarea" type="text" placeholder="Type your text here"></textarea>
        </div>
      </div>

      <!-- Block 3: Service location -->
      <div class="task-block">
        <h2 class="task-block__header">Service location</h2>
        <div class="task-block__wrapper">
          <input name="address" class="task-block__input" type="text" placeholder="Address" required />
          <input name="city" class="task-block__input" type="text" placeholder="City" required />
          <input name="street" class="task-block__input" type="text" placeholder="Street, building" required />
          <input name="index" class="task-block__input" type="text" placeholder="Postal code" required />

          <?php
          if ($result && $result['success'] && !empty($result['data'])) {
            foreach ($result['data'] as $field) {
              if ($field['name'] === 'region') {
                if (isset($field['options']) && is_array($field['options'])) {

                  $optionsHtml = "";
                  foreach ($field['options'] as $option) {

                    $optionsHtml .= "<option value='" . htmlspecialchars($option['label']) . "'>" . htmlspecialchars($option['label']) . "</option>";
                  }

                  $selectHtml = "<select name='region' class='task-block__select' required>" . $optionsHtml . "</select>";
                  echo $selectHtml;
                  break;
                } else {
                  echo "Массив 'options' не найден или не является массивом.";
                }
              }
            }
          } else {
            echo "Ошибка или данные отсутствуют";
          }
          ?>
        </div>
      </div>

      <!-- Block 4: Scheduled -->
      <div class="task-block">
        <h2 class="task-block__header">Scheduled</h2>
        <div class="task-block__wrapper">
          <input name="date" class="task-block__input" type="date" />
          <input name="start-time" class="task-block__input" type="time" id="1" required />
          <input name="end-time" class="task-block__input" type="time" id="2" required />

          <?php
          $api_token = 'ef18432fb61d7e5ed2dfed66422dde735f486eb3';
          $company_domain = 'futurama';
          $getUsersUrl = 'https://' . $company_domain . '.pipedrive.com/api/v1/users?limit=500&api_token=' . $api_token;

          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $getUsersUrl);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

          $output = curl_exec($ch);
          curl_close($ch);

          $result = json_decode($output, true);

          if (empty($result['data'])) {
            exit('Smthg went wrong' . PHP_EOL);
          }

          $options = "";

          foreach ($result['data'] as $user) {
            $options .= "<option value='" . htmlspecialchars($user['id']) . "'>" . htmlspecialchars($user['name']) . "</option>";
          }

          $selectHtml = "<select name='technician' class='task-block__select' required>" . $options . "</select>";

          echo $selectHtml;
          ?>

        </div>
      </div>
    </div>
    <div class="task-buttons">
      <button type="submit" class="task-buttons__item submit-button">
        Add task
        <svg class="spinner spinner_hidden" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24">
          <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" opacity=".25" />
          <path d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z" class="spinner_ajPY" />
        </svg>
      </button>
      <button class="task-buttons__item">Cancel</button>
    </div>
  </form>
  <script src="app.js"></script>
</body>

</html>